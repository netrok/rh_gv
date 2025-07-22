<div class="bg-white p-6 rounded-lg shadow border border-gray-200">
    <h2 class="text-xl font-semibold mb-6 text-gray-800">
        {{ $modo === 'crear' ? 'Nuevo Empleado' : 'Editar Empleado' }}
    </h2>

    <form wire:submit.prevent="{{ $modo === 'crear' ? 'guardar' : 'actualizar' }}">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Número de empleado --}}
            <div>
                <label class="text-sm font-medium text-gray-700">Número de Empleado *</label>
                <input type="text" wire:model.defer="form.num_empleado" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
                @error('form.num_empleado') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Nombres --}}
            <div>
                <label class="text-sm font-medium text-gray-700">Nombres *</label>
                <input type="text" wire:model.defer="form.nombres" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
                @error('form.nombres') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Apellidos --}}
            <div>
                <label class="text-sm font-medium text-gray-700">Apellido Paterno</label>
                <input type="text" wire:model.defer="form.apellido_paterno" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">Apellido Materno</label>
                <input type="text" wire:model.defer="form.apellido_materno" class="w-full border rounded px-3 py-2">
            </div>

            {{-- Género y Estado Civil --}}
            <div>
                <label class="text-sm font-medium text-gray-700">Género</label>
                <select wire:model.defer="form.genero" class="w-full border rounded px-3 py-2">
                    <option value="">Seleccionar</option>
                    <option value="H">Hombre</option>
                    <option value="M">Mujer</option>
                    <option value="O">Otro</option>
                </select>
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">Estado Civil</label>
                <input type="text" wire:model.defer="form.estado_civil" class="w-full border rounded px-3 py-2">
            </div>

            {{-- Fecha de nacimiento y CURP --}}
            <div>
                <label class="text-sm font-medium text-gray-700">Fecha Nacimiento</label>
                <input type="date" wire:model.defer="form.fecha_nacimiento" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">CURP *</label>
                <input type="text" wire:model.defer="form.curp" class="w-full border rounded px-3 py-2">
                @error('form.curp') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- RFC y NSS --}}
            <div>
                <label class="text-sm font-medium text-gray-700">RFC *</label>
                <input type="text" wire:model.defer="form.rfc" class="w-full border rounded px-3 py-2">
                @error('form.rfc') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">NSS</label>
                <input type="text" wire:model.defer="form.nss" class="w-full border rounded px-3 py-2">
            </div>

            {{-- Teléfono y Email --}}
            <div>
                <label class="text-sm font-medium text-gray-700">Teléfono</label>
                <input type="text" wire:model.defer="form.telefono" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">Email *</label>
                <input type="email" wire:model.defer="form.email" class="w-full border rounded px-3 py-2">
                @error('form.email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Puesto y Departamento --}}
            <div>
                <label class="text-sm font-medium text-gray-700">Puesto</label>
                <input type="text" wire:model.defer="form.puesto" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">Departamento</label>
                <input type="text" wire:model.defer="form.departamento" class="w-full border rounded px-3 py-2">
            </div>

            {{-- Fecha de ingreso --}}
            <div>
                <label class="text-sm font-medium text-gray-700">Fecha Ingreso</label>
                <input type="date" wire:model.defer="form.fecha_ingreso" class="w-full border rounded px-3 py-2">
            </div>

            {{-- Foto (preview) --}}
            <div>
                <label class="text-sm font-medium text-gray-700">Foto</label>
                <input type="file" wire:model="foto" class="w-full">
                @error('foto') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                @if ($foto)
                    <div class="mt-2">
                        <img src="{{ $foto->temporaryUrl() }}" class="w-32 h-32 object-cover rounded border">
                    </div>
                @elseif ($fotoActual)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $fotoActual) }}" class="w-32 h-32 object-cover rounded border">
                    </div>
                @endif
            </div>

            {{-- Estado Activo --}}
            <div class="flex items-center gap-2 mt-6">
                <input type="checkbox" wire:model.defer="form.activo" class="form-checkbox rounded text-blue-600">
                <label class="text-sm text-gray-700">Empleado activo</label>
            </div>
        </div>

        <div class="flex gap-3 mt-8">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded">
                Guardar
            </button>
            <button type="button" wire:click="cancelar"
                class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded">
                Cancelar
            </button>
        </div>
    </form>
</div>
