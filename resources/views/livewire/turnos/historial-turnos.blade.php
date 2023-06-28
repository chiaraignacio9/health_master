@if (session()->has('mensaje'))
    <div class="px-3 py-3 bg-green-400 border-green-600 rounded w-1/2 text-center">
        {{ session('mensaje') }}
    </div>
@endif

<div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

        @forelse ($turnos as $turno)


        <div class="p-6 text-gray-900 border-b md:flex md:justify-between md:items-center">
            <div class="leading-10">
                <a href="" class="text-xl font-bold">
                    Fecha: {{$turno->fecha}} - Hora:{{$turno->hora}}
                </a>
                <p class="text-sm text-gray-500 ">
                    {{ $turno->estado }}
                </p>
            </div>

            <div class="flex flex-col items-stretch md:flex-row gap-3 text-center mt-5 md:mt-0">
                <a
                    href="#"
                    class="bg-red-600 py-2 px-4 rounded text-white text-xs font-bold uppercase"
                >Cancelar</a>
            </div>
        </div>

        @empty
            <p class="pt-3 text-center text-gray-600">No hay turnos para mostrar</p>
        @endforelse
    </div>
</div>
