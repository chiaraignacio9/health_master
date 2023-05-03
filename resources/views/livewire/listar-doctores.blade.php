<div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <a class="py-2 px-3 bg-cyan-200 font-semibold rounded text-center" href="{{ route('doctores.create') }}">Crear Doctor</a>

        @forelse ($doctores as $doctor)


        <div class="p-6 text-gray-900 border-b md:flex md:justify-between md:items-center">
            <div class="leading-10">
                @php
                    $doctorInfo = json_decode($doctor->getUserData(), true);
                @endphp
                <a href="" class="text-xl font-bold">
                    {{ $doctorInfo[0]['nombre'] . ' ' . $doctorInfo[0]['apellido']}}
                </a>
                <p class="text-gray-400 text-sm">
                    Especialidad: <strong>{{$doctor->obtenerEspecialidad()}}</strong>
                </p>
            </div>

            <div class="flex flex-col items-stretch md:flex-row gap-3 text-center mt-5 md:mt-0">
                <a
                    href=""
                    class="bg-blue-800 py-2 px-4 rounded text-white text-xs font-bold uppercase"
                >Editar</a>
                <a
                    href="#"
                    class="bg-red-600 py-2 px-4 rounded text-white text-xs font-bold uppercase"
                >Eliminar</a>
            </div>
        </div>

        @empty
            <p class="pt-3 text-center text-gray-600">No hay doctores para mostrar</p>
            <a class="text-center text-blue-500 text-xs" href="{{ route('doctores.create') }}">Crear un doctor</a>
        @endforelse
    </div>
</div>
