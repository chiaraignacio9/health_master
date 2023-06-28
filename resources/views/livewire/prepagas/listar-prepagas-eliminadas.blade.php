    <div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <a class="py-2 px-3 bg-cyan-200 font-semibold rounded text-center" href="{{ route('prepagas.create') }}">Crear Prepaga</a>
        <a class="py-2 px-3 bg-yellow-200 font-semibold rounded text-center" href="{{ route('prepagas.eliminados') }}">Ver eliminadas</a>
        @forelse ($prepagas as $prepaga)
        <div class="p-6 text-gray-900 border-b md:flex md:justify-between md:items-center">
            <div class="leading-10">
                <a href="" class="text-xl font-bold">
                    {{ $prepaga->nombre}}
                </a>
                <p class="text-sm text-gray-500 ">
                    Descuento : {{$prepaga->descuento}}%
                </p>
            </div>

            <div class="flex flex-col items-stretch md:flex-row gap-3 text-center mt-5 md:mt-0">
                <a
                    href="{{ route('prepagas.edit', ['prepaga' => $prepaga]) }}"
                    class="bg-blue-800 py-2 px-4 rounded text-white text-xs font-bold uppercase"
                >Editar</a>
                <button
                    wire:click="$emit('deleteAlert', {{ $prepaga->id }})"
                    class="bg-red-600 py-2 px-4 rounded text-white text-xs font-bold uppercase"
                >Eliminar</button>
            </div>
        </div>

        @empty
            <p class="pt-3 text-center text-gray-600">No hay prepagas para mostrar</p>
            <a class="text-center text-blue-500 text-xs" href="{{ route('prepagas.create') }}">Crear una prepaga</a>
        @endforelse
    </div>
</div>

@push('sweetalert')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        Livewire.on('deleteAlert', id=> {
            Swal.fire({
                title: 'Desea eliminar la prepaga?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('eliminarPrepaga', id);
                    Swal.fire(
                        'Eliminada!',
                        'La prepaga ha sido eliminado.',
                        'success'
                    )
                }
            })
        })
        </script>
@endpush
