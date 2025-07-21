<div class="bg-gray-100 p-4 rounded shadow-md">
    <h2 class="text-lg font-semibold mb-2">{{ $modo === 'crear' ? 'Nuevo Empleado' : 'Editar Empleado' }}</h2>

    <form wire:submit.prevent="{{ $modo === 'crear' ? 'guardar' : 'actualizar' }}">
        <div class="mb-2">
            <label class="block text-sm">Nombre:</label>
            <input type="text" wire:model="form.nombres" class="w-full border rounded px-2 py-1">
            @error('form.nombres') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-2">
            <label class="block text-sm">Puesto:</label>
            <input type="text" wire:model="form.puesto" class="w-full border rounded px-2 py-1">
        </div>

        <div class="flex gap-2 mt-3">
            <button type="submit" class="bg-green-500 text-white px-4 py-1 rounded">Guardar</button>
            <button type="button" wire:click="cancelar" class="bg-gray-400 text-white px-4 py-1 rounded">Cancelar</button>
        </div>
    </form>
</div>
