<x-app-layout>

    @if (session()->has('mensaje'))
    <div class="px-3 py-3 bg-green-400 border-green-600 rounded w-1/2 text-center">
        {{ session('mensaje') }}
    </div>
    @endif

    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            @if (Auth::user()->rol_id == 3)
                <h2 class="text-xl font-semibold leading-tight">
                    {{ __('Sacar un turno') }}
                </h2>
            @elseif (Auth::user()->rol_id == 2)
                <h2 class="text-xl font-semibold leading-tight">
                    {{ __('Turnos por atender') }}
                </h2>
            @elseif (Auth::user()->rol_id == 1)
                <h2 class="text-xl font-semibold leading-tight">
                    {{ __('Dashboard') }}
                </h2>
            @endif
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        Bievenido {{ Auth::user()->nombre }}
    </div>


    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        @if (Auth::user()->rol_id == 3)
            @livewire('listar-turnos')
        @endif
    </div>


</x-app-layout>
