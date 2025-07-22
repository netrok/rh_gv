<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Empleados Eliminados</h1>

    <button wire:click="volver" class="bg-gray-500 text-white px-4 py-2 rounded mb-4">
        ← Volver a la lista
    </button>

    <table class="w-full table-auto border">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="px-4 py-2">#</th>
                <th class="px-4 py-2">Nombre</th>
                <th class="px-4 py-2">Puesto</th>
                <th class="px-4 py-2">Eliminado el</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($empleadosEliminados as $empleado)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $empleado->num_empleado }}</td>
                    <td class="px-4 py-2">{{ $empleado->nombre_completo }}</td>
                    <td class="px-4 py-2">{{ $empleado->puesto }}</td>
                    <td class="px-4 py-2 text-sm text-gray-600">
                        {{ optional($empleado->deleted_at)->format('d/m/Y H:i') }}
                    </td>
                    <td class="px-4 py-2">
                        <button wire:click="restaurarEmpleado({{ $empleado->id }})"
                            class="text-green-600 hover:underline">Restaurar</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 py-2 text-center text-gray-500">No hay empleados eliminados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
