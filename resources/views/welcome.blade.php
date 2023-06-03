<x-app-layout>
    <div class="py-16 bg-gray-50 overflow-hidden lg:py-10">
        <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 lg:max-w-7xl">

            <div class="relative">
                <center>
                    <x-logov2 />
                </center>
                <h2 class="text-center text-4xl leading-8 font-extrabold tracking-tight text-indigo-600 sm:text-6xl"
                style="color: #536D79"
                >
                    Brindando cuidado médico excepcional para tu bienestar
                </h2>
                <p class="mt-4 max-w-3xl mx-auto text-center text-xl text-gray-500">
                    Bienvenido/a a <span class="font-bold">Health Master</span>, donde tu salud y bienestar son nuestra prioridad.
                </p>
                <div class="text-center my-10">
                    <a style="background-color: #2EA6D7;" class="px-4 py-2 rounded text-white hover:bg-cyan-700" href="{{ route('login') }}">Solicitar turno</a>
                    <p class="text-gray-400 text-sm my-2">Si es tu primera vez, deberás acercarte presencialmente a la clinica para dar de alta el usuario</p>
                </div>
            </div>

            <div>
                <h2 class="text-center text-3xl leading-8 font-extrabold tracking-tight text-indigo-600 sm:text-3xl">Conocé a nuestros profesionales</h2>
                <div class="my-4 grid grid-cols-1 sm:grid-cols-3">
                    @foreach ($doctores as $doctor)
                    <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <div class="flex justify-end px-4 pt-4">
                        </div>
                        <div class="flex flex-col items-center pb-10">
                            <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="{{ asset('storage/imagenes/' . $doctor->image_path) }}" alt="Foto de {{ $doctor->nombre }}"/>
                            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $doctor->nombre . ' ' . $doctor->apellido }}</h5>
                            <span class="text-sm text-gray-500 dark:text-gray-400">{{$doctor->especialidad}}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
