<form class="w-full space-y-5" autocomplete="off" wire:submit.prevent="guardarPrepaga">
    <div class="w-full flex gap-2">
        <div class="w-1/2">
            <x-form.label for="nombre" :value="__('Nombre de la prepaga')" />
            <x-form.input
                id="nombre"
                wire:model="nombre"
                class="block mt-1 w-full"
                type="text" name="nombre"
                :value="old('nombre')"
                placeholder="Nombre de la prepaga"
            />

            @error('nombre')
                <livewire:mostrar-alerta :message="$message">
            @enderror

        </div>
        <div class="w-1/2">
            <x-form.label for="descuento" :value="__('Descuento para el cliente')" />
            <div class="flex flex-row">
                <x-form.input
                id="descuento"
                wire:model="descuento"
                class="block mt-1 basis-3/4 border-r-0"
                type="number" name="descuento"
                :value="old('descuento')"
                placeholder="Ejemplo: 15%"
            />
            <x-form.label
                class="block mt-1 bg-gray-400 font-bold basis-4/4 rounded text-center"
                type="text" name=""
                value="%"
                readonly
            />
            </div>
            @error('descuento')
                <livewire:mostrar-alerta :message="$message">
            @enderror
        </div>
    </div>

    <hr>

    <div class="text-center">
        <input class="cursor-pointer hover:bg-green-700 hover:text-white py-2 px-3 bg-green-400 rounded font-semibold" type="submit" value="Crear prepaga">
    </div>
</form>
