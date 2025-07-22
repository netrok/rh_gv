<?php

namespace App\Livewire\Empleados;

use App\Models\Empleado;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use WithFileUploads, WithPagination;

    public $form = [];
    public $foto;
    public $fotoActual;
    public $formVisible = false;
    public $modo = 'crear';
    public $editId = null;

    public $modoPapelera = false;
    public $mostrarConfirmacion = false;
    public $accionPendiente;
    public $idSeleccionado;
    public $confirmacionTexto;

    protected $paginationTheme = 'tailwind';

    public $filtroNombre = '';
    public $filtroPuesto = '';
    public $filtroDepartamento = '';

    public function render()
    {
        if ($this->modoPapelera) {
            return view('livewire.empleados.papelera', [
                'empleados' => collect(),
                'empleadosEliminados' => Empleado::onlyTrashed()
                    ->orderBy('deleted_at', 'desc')
                    ->paginate(10),
            ]);
        }

        $empleados = Empleado::query()
            ->when($this->filtroNombre, function ($q) {
                $q->where(function ($subquery) {
                    $subquery->where('nombres', 'like', "%{$this->filtroNombre}%")
                             ->orWhere('apellido_paterno', 'like', "%{$this->filtroNombre}%");
                });
            })
            ->when($this->filtroPuesto, fn($q) =>
                $q->where('puesto', 'like', "%{$this->filtroPuesto}%")
            )
            ->when($this->filtroDepartamento, fn($q) =>
                $q->where('departamento', 'like', "%{$this->filtroDepartamento}%")
            )
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.empleados.index', [
            'empleados' => $empleados,
            'empleadosEliminados' => [],
        ]);
    }

    public function updating($property)
    {
        if (in_array($property, ['filtroNombre', 'filtroPuesto', 'filtroDepartamento'])) {
            $this->resetPage();
        }
    }

    public function aplicarFiltros()
    {
        // No hace nada directamente; solo fuerza render con filtros cargados
    }

    public function limpiarFiltros()
    {
        $this->reset(['filtroNombre', 'filtroPuesto', 'filtroDepartamento']);
        $this->resetPage();
    }

    public function crearEmpleado()
    {
        $this->reset(['form', 'foto', 'fotoActual']);
        $this->form['activo'] = true;
        $this->formVisible = true;
        $this->modo = 'crear';
    }

    public function guardar()
    {
        $this->validate([
            'form.nombres' => 'required|string|min:3',
            'form.curp' => 'required|string|unique:empleados,curp',
            'form.rfc' => 'required|string|unique:empleados,rfc',
            'form.email' => 'required|email|unique:empleados,email',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048|dimensions:min_width=200,min_height=200',
        ]);

        $numEmpleado = $this->generarNumeroEmpleado();
        $path = $this->foto ? $this->foto->store('empleados', 'public') : null;

        Empleado::create(array_merge($this->form, [
            'num_empleado' => $numEmpleado,
            'foto' => $path,
        ]));

        $this->refrescar();
    }

    public function editarEmpleado($id)
    {
        $empleado = Empleado::findOrFail($id);

        $this->form = [
            'num_empleado' => $empleado->num_empleado,
            'nombres' => $empleado->nombres,
            'apellido_paterno' => $empleado->apellido_paterno,
            'apellido_materno' => $empleado->apellido_materno,
            'genero' => $empleado->genero,
            'estado_civil' => $empleado->estado_civil,
            'fecha_nacimiento' => optional($empleado->fecha_nacimiento)->format('Y-m-d'),
            'curp' => $empleado->curp,
            'rfc' => $empleado->rfc,
            'nss' => $empleado->nss,
            'telefono' => $empleado->telefono,
            'email' => $empleado->email,
            'puesto' => $empleado->puesto,
            'departamento' => $empleado->departamento,
            'fecha_ingreso' => optional($empleado->fecha_ingreso)->format('Y-m-d'),
            'activo' => $empleado->activo,
        ];

        $this->fotoActual = $empleado->foto;
        $this->foto = null;
        $this->editId = $id;
        $this->modo = 'editar';
        $this->formVisible = true;
    }

    public function actualizar()
    {
        $this->validate([
            'form.nombres' => 'required|string|min:3',
            'form.curp' => ['required', 'string', Rule::unique('empleados', 'curp')->ignore($this->editId)],
            'form.rfc' => ['required', 'string', Rule::unique('empleados', 'rfc')->ignore($this->editId)],
            'form.email' => ['required', 'email', Rule::unique('empleados', 'email')->ignore($this->editId)],
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048|dimensions:min_width=200,min_height=200',
        ]);

        $empleado = Empleado::findOrFail($this->editId);
        $path = $empleado->foto;

        if ($this->foto) {
            if ($path && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }

            $path = $this->foto->store('empleados', 'public');
        }

        $empleado->update(array_merge($this->form, ['foto' => $path]));

        $this->refrescar();
    }

    public function confirmarEliminacion($id)
    {
        $this->idSeleccionado = $id;
        $empleado = Empleado::findOrFail($id);
        $this->confirmacionTexto = "¿Seguro que deseas eliminar al empleado {$empleado->nombres} {$empleado->apellido_paterno}?";
        $this->accionPendiente = 'eliminar';
        $this->mostrarConfirmacion = true;
    }

    public function confirmarRestaurar($id)
    {
        $this->idSeleccionado = $id;
        $empleado = Empleado::onlyTrashed()->findOrFail($id);
        $this->confirmacionTexto = "¿Deseas restaurar al empleado {$empleado->nombres} {$empleado->apellido_paterno}?";
        $this->accionPendiente = 'restaurar';
        $this->mostrarConfirmacion = true;
    }

    public function ejecutarAccion()
    {
        if ($this->accionPendiente === 'eliminar') {
            $this->eliminarEmpleado($this->idSeleccionado);
        }

        if ($this->accionPendiente === 'restaurar') {
            $this->restaurarEmpleado($this->idSeleccionado);
        }

        $this->mostrarConfirmacion = false;
        $this->reset(['idSeleccionado', 'accionPendiente']);
    }

    public function eliminarEmpleado($id)
    {
        $empleado = Empleado::findOrFail($id);
        $empleado->delete();
        $this->resetPage();
    }

    public function restaurarEmpleado($id)
    {
        $empleado = Empleado::onlyTrashed()->findOrFail($id);
        $empleado->restore();
        $this->resetPage();
    }

    public function verPapelera()
    {
        $this->modoPapelera = true;
        $this->resetPage();
    }

    public function volver()
    {
        $this->modoPapelera = false;
        $this->resetPage();
    }

    public function cancelar()
    {
        $this->formVisible = false;
        $this->reset(['form', 'editId', 'foto', 'fotoActual']);
    }

    private function refrescar()
    {
        $this->formVisible = false;
        $this->reset(['form', 'editId', 'foto', 'fotoActual']);
    }

    private function generarNumeroEmpleado(): string
    {
        $ultimo = Empleado::max('id') ?? 0;
        return 'EMP' . str_pad($ultimo + 1, 5, '0', STR_PAD_LEFT);
    }
}
