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
                    {{ $turno->nombre . ' ' . $turno->apellido}} - Hora:{{$turno->hora}}
                </a>
                <p class="text-sm text-gray-500 ">

                </p>
            </div>

            <div class="flex flex-col items-stretch md:flex-row gap-3 text-center mt-5 md:mt-0">
                <a
                    href="#"
                    class="bg-red-600 py-2 px-4 rounded text-white text-xs font-bold uppercase"
                >Cancelar</a>
                <a
                    href="{{ route('turnos.edit', ['turno' => $turno->idTurno]) }}"
                    class="bg-blue-600 py-2 px-4 rounded text-white text-xs font-bold uppercase"
                >Atender</a>
            </div>
        </div>

        @empty
            <p class="pt-3 text-center text-gray-600">No hay turnos pendientes para el día de hoy</p>
        @endforelse
    </div>
</div>
