<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Empleados</h1>

    <button wire:click="crearEmpleado" class="bg-blue-500 text-white px-4 py-2 rounded">+ Nuevo Empleado</button>

    <div class="mt-6">
        @if($formVisible)
            @include('livewire.empleados.form')
        @endif
    </div>

    <div class="mt-6">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Puesto</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($empleados as $empleado)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $empleado->num_empleado }}</td>
                        <td class="px-4 py-2">{{ $empleado->nombres }} {{ $empleado->apellido_paterno }}</td>
                        <td class="px-4 py-2">{{ $empleado->puesto }}</td>
                        <td class="px-4 py-2">
                            <button wire:click="editarEmpleado({{ $empleado->id }})" class="text-blue-500">Editar</button>
                            <button wire:click="eliminarEmpleado({{ $empleado->id }})" class="text-red-500 ml-2">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
