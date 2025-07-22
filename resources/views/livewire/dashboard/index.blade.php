<?php
namespace App\Livewire\Dashboard;

use App\Models\Empleado;
use Livewire\Component;

class Index extends Component
{
    public $total;
    public $activos;
    public $inactivos;
    public $hombres;
    public $mujeres;

    public function mount()
    {
        $this->total = Empleado::count();
        $this->activos = Empleado::where('activo', true)->count();
        $this->inactivos = Empleado::where('activo', false)->count();
        $this->hombres = Empleado::where('genero', 'H')->count();
        $this->mujeres = Empleado::where('genero', 'M')->count();
    }

    public function render()
    {
        return view('livewire.dashboard.index');
    }
}
