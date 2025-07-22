<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Empleado extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'empleados';

    protected $fillable = [
        'num_empleado',
        'nombres',
        'apellido_paterno',
        'apellido_materno',
        'fecha_nacimiento',
        'genero',
        'estado_civil',
        'curp',
        'rfc',
        'nss',
        'telefono',
        'email',
        'puesto',
        'departamento',
        'fecha_ingreso',
        'activo',
        'foto',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'fecha_ingreso' => 'date',
        'activo' => 'boolean',
    ];

    // Accesor para mostrar nombre completo
    public function getNombreCompletoAttribute(): string
    {
        return "{$this->nombres} {$this->apellido_paterno} {$this->apellido_materno}";
    }

    // Accesor para URL pública de la foto
    public function getFotoUrlAttribute(): ?string
    {
        return $this->foto ? asset('storage/' . $this->foto) : null;
    }
}
