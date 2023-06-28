<form class="w-full space-y-5" autocomplete="off" wire:submit.prevent="actualizarPrepaga">
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
        <input class="cursor-pointer hover:bg-green-700 hover:text-white py-2 px-3 bg-green-400 rounded font-semibold" type="submit" value="Actualizar prepaga">
    </div>
</form>

@push('sweetalert')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            window.addEventListener('alerta', function(){
                Swal.fire({
                    icon: 'success',
                    title: 'Prepaga editada con éxito',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = ' {{ route('prepagas.index') }} ';
                    }
                });
            })
        </script>
@endpush
