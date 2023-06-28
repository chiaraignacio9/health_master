<div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <a class="py-2 px-3 bg-cyan-200 font-semibold rounded text-center" href="{{ route('doctores.create') }}">Crear Doctor</a>
        <a class="py-2 px-3 bg-yellow-200 font-semibold rounded text-center" href="{{ route('doctores.eliminados') }}">Ver eliminados</a>
        @forelse ($doctores as $doctor)


        <div class="p-6 text-gray-900 border-b md:flex md:justify-between md:items-center">
            <div class="leading-10">
                <a href="" class="text-xl font-bold">
                    {{ $doctor->nombre . ' ' . $doctor->apellido}}
                </a>
                <p class="text-gray-400 text-sm">
                    Especialidad: <strong>{{$doctor->especialidad}}</strong>
                </p>
            </div>

            <div class="flex flex-col items-stretch md:flex-row gap-3 text-center mt-5 md:mt-0">
                <a
                    href="{{route('doctores.edit', ['doctore' => $doctor->id])}}"
                    class="bg-blue-800 py-2 px-4 rounded text-white text-xs font-bold uppercase"
                >Editar</a>
                <button
                    wire:click="$emit('deleteAlert', {{ $doctor->id }})"
                    class="bg-red-600 py-2 px-4 rounded text-white text-xs font-bold uppercase"
                >Eliminar</button>
            </div>
        </div>

        @empty
            <p class="pt-3 text-center text-gray-600">No hay doctores para mostrar</p>
            <a class="text-center text-blue-500 text-xs" href="{{ route('doctores.create') }}">Crear un doctor</a>
        @endforelse
    </div>
</div>

@push('sweetalert')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        Livewire.on('deleteAlert', id=> {
            Swal.fire({
                title: 'Desea eliminar el doctor?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('eliminarDoctor', id);
                    Swal.fire(
                        'Eliminado!',
                        'El doctor ha sido eliminado.',
                        'success'
                    )
                }
            })
        })
        </script>
@endpush
