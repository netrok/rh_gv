<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        foreach (['SuperAdmin', 'Admin', 'RRHH', 'Supervisor', 'Gerente', 'Usuario'] as $rol) {
            Role::firstOrCreate(['name' => $rol]);
        }
    }
}
