<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Empleados</h1>

    <div class="flex justify-between items-center mb-4 flex-wrap gap-2">
        <div class="flex gap-2">
            <button wire:click="crearEmpleado" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                <i class="fas fa-plus mr-1"></i> Nuevo Empleado
            </button>

            <button wire:click="verPapelera" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                <i class="fas fa-trash-alt mr-1"></i> {{ $modoPapelera ? 'Ver activos' : 'Papelera' }}
            </button>
        </div>
    </div>

    @if($formVisible)
        <div class="mb-6">
            @include('livewire.empleados.form')
        </div>
    @endif

    {{-- Filtros --}}
    <div class="bg-gray-100 border border-gray-300 rounded-lg p-4 mb-6 shadow-sm">
        <h3 class="text-lg font-semibold mb-4 text-gray-700 flex items-center gap-2">
            <i class="fas fa-filter text-gray-500"></i> Filtros de búsqueda
        </h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <div>
                <label for="filtroNombre" class="block text-sm font-medium text-gray-600 mb-1">Nombre</label>
                <input type="text" id="filtroNombre" wire:model.lazy="filtroNombre" placeholder="Ej. Juan"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300">
            </div>

            <div>
                <label for="filtroPuesto" class="block text-sm font-medium text-gray-600 mb-1">Puesto</label>
                <input type="text" id="filtroPuesto" wire:model.lazy="filtroPuesto" placeholder="Ej. Auxiliar"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300">
            </div>

            <div>
                <label for="filtroDepartamento"
                    class="block text-sm font-medium text-gray-600 mb-1">Departamento</label>
                <input type="text" id="filtroDepartamento" wire:model.lazy="filtroDepartamento" placeholder="Ej. RH"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300">
            </div>
        </div>

        <div class="mt-4 flex justify-end gap-3">
            <button wire:click="aplicarFiltros"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded font-medium shadow">
                <i class="fas fa-search mr-1"></i> Buscar
            </button>

            <button wire:click="limpiarFiltros"
                class="bg-gray-400 hover:bg-gray-500 text-white px-5 py-2 rounded font-medium shadow">
                <i class="fas fa-eraser mr-1"></i> Limpiar
            </button>
        </div>
    </div>



    {{-- Tabla de empleados --}}
    <div class="overflow-x-auto shadow rounded">
        <table class="w-full table-auto border-collapse">
            <thead class="bg-gray-200 text-left">
                <tr>
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Puesto</th>
                    <th class="px-4 py-2">Departamento</th>
                    <th class="px-4 py-2">Estado</th>
                    <th class="px-4 py-2 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($empleados as $empleado)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $empleado->num_empleado }}</td>
                        <td class="px-4 py-2">{{ $empleado->nombres }} {{ $empleado->apellido_paterno }}</td>
                        <td class="px-4 py-2">{{ $empleado->puesto }}</td>
                        <td class="px-4 py-2">{{ $empleado->departamento }}</td>
                        <td class="px-4 py-2">
                            @if ($empleado->activo)
                                <span class="text-green-600 font-semibold">Activo</span>
                            @else
                                <span class="text-red-600 font-semibold">Inactivo</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 text-right">
                            @if ($modoPapelera)
                                <button wire:click="confirmarRestaurar({{ $empleado->id }})"
                                    class="text-blue-600 hover:underline">
                                    Restaurar
                                </button>
                            @else
                                <button wire:click="editarEmpleado({{ $empleado->id }})"
                                    class="text-blue-600 hover:underline mr-2">
                                    Editar
                                </button>
                                <button wire:click="confirmarEliminacion({{ $empleado->id }})"
                                    class="text-red-600 hover:underline">
                                    Eliminar
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-gray-500">No se encontraron empleados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="mt-6">
        {{ $empleados->links() }}
    </div>

    {{-- Modal de confirmación --}}
    @if ($mostrarConfirmacion)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md text-center">
                <p class="text-lg font-semibold mb-4">{{ $confirmacionTexto }}</p>

                <div class="flex justify-center gap-4">
                    <button wire:click="ejecutarAccion" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                        Sí, confirmar
                    </button>

                    <button wire:click="$set('mostrarConfirmacion', false)"
                        class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>