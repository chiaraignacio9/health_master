<form class="w-full space-y-5" autocomplete="off" wire:submit.prevent="asignarTurno">

    <div class="w-full flex gap-2">
        <div class="w-1/2">
            <x-form.label for="nombre" :value="__('Fecha del turno')" />
            <x-form.input
                readonly
                id="fecha"
                wire:model="fecha"
                class="block mt-1 w-full"
                type="text" name="fecha"
                :value="old('fecha')"
            />
        </div>
        <div class="w-1/2">
            <x-form.label for="descuento" :value="__('Hora')" />
            <x-form.input
            readonly
            id="hora"
            wire:model="hora"
            class="block mt-1 w-full"
            type="text" name="hora"
            :value="old('hora')"
            />
        </div>
    </div>
    <div class="w-full flex gap-2">
        <div class="w-1/2">
            <x-form.label for="dni" :value="__('DNI del paciente')" />
            <x-form.input
                id="dni"
                wire:model="dni"
                class="block mt-1 w-full"
                type="text" name="dni"
                :value="old('dni')"
                wire:keyup="buscarPaciente"
            />
        </div>
        <div class="w-1/2">
            <x-form.label for="nombre" :value="__('Nombre')" />
            <x-form.input
            id="nombre"
            wire:model="nombre"
            class="block mt-1 w-full"
            type="text" name="nombre"
            :value="old('nombre')"
            />
        </div>
    </div>

    <hr>

    <div class="text-center">
        <input class="cursor-pointer hover:bg-green-700 hover:text-white py-2 px-3 bg-green-400 rounded font-semibold" type="submit" value="Asignar turno">
    </div>
</form>
