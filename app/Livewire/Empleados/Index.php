<?php

namespace App\Livewire\Empleados;

use App\Models\Empleado;
use Livewire\Component;

class Index extends Component
{
    public $empleados;
    public $form = [];
    public $formVisible = false;
    public $modo = 'crear';
    public $editId = null;

    public function mount()
    {
        $this->empleados = Empleado::all();
    }

    public function render()
    {
        return view('livewire.empleados.index');
    }

    public function crearEmpleado()
    {
        $this->reset('form');
        $this->formVisible = true;
        $this->modo = 'crear';
    }

    public function guardar()
    {
        $this->validate([
            'form.nombres' => 'required|string|min:3',
        ]);

        Empleado::create($this->form);
        $this->refrescar();
    }

    public function editarEmpleado($id)
    {
        $empleado = Empleado::findOrFail($id);
        $this->form = $empleado->toArray();
        $this->editId = $id;
        $this->modo = 'editar';
        $this->formVisible = true;
    }

    public function actualizar()
    {
        $this->validate([
            'form.nombres' => 'required|string|min:3',
        ]);

        Empleado::find($this->editId)->update($this->form);
        $this->refrescar();
    }

    public function eliminarEmpleado($id)
    {
        Empleado::destroy($id);
        $this->refrescar();
    }

    public function cancelar()
    {
        $this->formVisible = false;
        $this->reset(['form', 'editId']);
    }

    private function refrescar()
    {
        $this->formVisible = false;
        $this->empleados = Empleado::all();
        $this->reset(['form', 'editId']);
    }
}
