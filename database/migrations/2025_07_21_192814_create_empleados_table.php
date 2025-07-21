<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('num_empleado')->unique();
            $table->string('nombres');
            $table->string('apellido_paterno');
            $table->string('apellido_materno')->nullable();
            $table->date('fecha_nacimiento');
            $table->string('genero');
            $table->string('estado_civil')->nullable();
            $table->string('curp')->unique();
            $table->string('rfc')->unique();
            $table->string('nss')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->unique();
            $table->string('puesto')->nullable();
            $table->string('departamento')->nullable();
            $table->date('fecha_ingreso')->nullable();
            $table->boolean('activo')->default(true);
            $table->string('foto')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
