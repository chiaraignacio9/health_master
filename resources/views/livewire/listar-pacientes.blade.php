@if (session()->has('mensaje'))
    <div class="px-3 py-3 bg-green-400 border-green-600 rounded w-1/2 text-center">
        {{ session('mensaje') }}
    </div>
@endif

<div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <a class="py-2 px-3 bg-cyan-200 font-semibold rounded text-center" href="{{ route('pacientes.create') }}">Crear Paciente</a>

        @forelse ($pacientes as $paciente)


        <div class="p-6 text-gray-900 border-b md:flex md:justify-between md:items-center">
            <div class="leading-10">
                @php
                    $pacienteDatos = json_decode($paciente->getUserData(), true);
                @endphp
                <a href="" class="text-xl font-bold">
                    {{ $pacienteDatos[0]['nombre'] . ' ' . $pacienteDatos[0]['apellido']}}
                </a>
                <p class="text-sm text-gray-500 ">
                    @if ($paciente->ultima_consulta != null)
                    Último consulta: {{ $paciente->ultima_consulta }}
                    @else
                    Nunca ha sido atendido
                    @endif

                </p>
            </div>

            <div class="flex flex-col items-stretch md:flex-row gap-3 text-center mt-5 md:mt-0">
                <a
                    href="{{route('pacientes.edit', ['paciente' => $paciente])}}"
                    class="bg-blue-800 py-2 px-4 rounded text-white text-xs font-bold uppercase"
                >Editar</a>
                <a
                    href="#"
                    class="bg-red-600 py-2 px-4 rounded text-white text-xs font-bold uppercase"
                >Eliminar</a>
            </div>
        </div>

        @empty
            <p class="pt-3 text-center text-gray-600">No hay pacientes para mostrar</p>
            <a class="text-center text-blue-500 text-xs" href="{{ route('pacientes.create') }}">Crear un paciente</a>
        @endforelse
    </div>
</div>
