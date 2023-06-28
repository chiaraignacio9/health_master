<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Atender turno') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <form class="w-full space-y-5" autocomplete="off" wire:submit.prevent="atenderTurno">

            <label for="observaciones">Escriba las observaciones</label>
            <textarea name="observaciones" id="observaciones" cols=30" rows="5"></textarea>

            <hr>

            <div class="text-center">
                <input class="cursor-pointer hover:bg-green-700 hover:text-white py-2 px-3 bg-green-400 rounded font-semibold" type="submit" value="Guardar">
            </div>
        </form>

    </div>
</x-app-layout>
