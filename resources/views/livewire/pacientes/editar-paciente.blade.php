<form class="w-full space-y-5" autocomplete="off" wire:submit.prevent="actualizarPaciente">
    <div class="w-full flex gap-2">
        <div class="w-1/2">
            <x-form.label for="firstname" :value="__('Nombre del paciente')" />
            <x-form.input
                id="nombre"
                wire:model="nombre"
                class="block mt-1 w-full"
                type="text" name="nombre"
                :value="old('nombre')"
                placeholder="Nombre del paciente"
            />

            @error('nombre')
                <livewire:mostrar-alerta :message="$message">
            @enderror

        </div>
        <div class="w-1/2">
            <x-form.label for="apellido" :value="__('Apellido del paciente')" />
            <x-form.input
                id="apellido"
                wire:model="apellido"
                class="block mt-1 w-full"
                type="text" name="apellido"
                :value="old('apellido')"
                placeholder="Apellido del paciente"
            />
            @error('apellido')
                <livewire:mostrar-alerta :message="$message">
            @enderror
        </div>
    </div>

    <div class="w-full">
        <div>
            <x-form.label for="email" :value="__('Correo electronico')" />
            <x-form.input
                id="email"
                wire:model="email"
                class="block mt-1 w-full"
                type="text" name="email"
                :value="old('email')"
                placeholder="ejemplo@correo.com"
            />

            @error('email')
                <livewire:mostrar-alerta :message="$message">
            @enderror
        </div>
    </div>

    <div class="w-full flex gap-2">
        <div class="w-1/2">
            <x-form.label for="nacimiento" :value="__('Fecha de Nacimiento')" />
            <x-form.input
                id="nacimiento"
                wire:model="nacimiento"
                class="block mt-1 w-full"
                type="date" name="nacimiento"
                :value="old('nacimiento')"
            />

            @error('nacimiento')
                <livewire:mostrar-alerta :message="$message">
            @enderror

        </div>
        <div class="w-1/2">
            <x-form.label for="dni" :value="__('Documento')" />
            <x-form.input
                id="dni"
                wire:model="dni"
                class="block mt-1 w-full"
                type="text" name="dni"
                :value="old('dni')"
                placeholder="DNI del paciente"
            />
            @error('dni')
                <livewire:mostrar-alerta :message="$message">
            @enderror
        </div>
    </div>

    <div class="w-full flex gap-2">
        <div class="w-1/2">
            <x-form.label for="id_prepaga" :value="__('Obra social')" />
            <select class="w-full text-center " wire:model="id_prepaga" name="id_prepaga" id="id_prepaga">
                <option>-- No posee obra social --</option>
                @foreach ($prepagas as $prepaga)
                    <option value="{{$prepaga->id}}">{{$prepaga->nombre}}</option>
                @endforeach
            </select>
        </div>
        <div class="w-1/2">
            <x-form.label for="numero_afiliado" :value="__('Número de Afiliado')" />
            <x-form.input
                id="numero_afiliado"
                wire:model="numero_afiliado"
                class="block mt-1 w-full"
                type="text" name="numero_afiliado"
                :value="old('numero_afiliado')"
                placeholder="Número de afiliado"
            />
        </div>
    </div>

    <div class="w-full flex gap-2">
        <div class="w-1/2">
            <x-form.label for="provincia" :value="__('Provincia')" />
            <select wire:change="actualizarDepartamentos" class="w-full text-center" wire:model="provinciaSeleccionada" id="provincia">
                <option>-- Seleccione una Provincia --</option>
                @foreach ($provincias as $provincia)
                    <option class="uppercase" value="{{$provincia['id']}}">{{$provincia['nombre']}}</option>
                @endforeach
            </select>
        </div>
        <div class="w-1/2">
                <x-form.label for="departamento" :value="__('Departamento')" />
                <select wire:change="actualizarLocalidades" class="w-full text-center" wire:model="departamentoSeleccionado" id="departamento">
                <option>-- Seleccione un departamento --</option>
                @if ($departamentos)
                    @foreach ($departamentos as $departamento)
                        <option class="uppercase" value="{{$departamento['id']}}">{{$departamento['nombre']}}</option>
                    @endforeach
                @endif
            </select>
            @error('cityid')
                <livewire:mostrar-alerta :message="$message">
            @enderror
        </div>
    </div>

    <div class="w-full flex gap-2">
        <div class="w-1/2">
            <x-form.label for="localidad" :value="__('Localidad')" />
            <select class="w-full text-center" wire:model="localidad" id="localidad">
                <option>-- Seleccione una localidad --</option>
                @if ($localidades)
                    @foreach ($localidades as $localidad)
                        <option class="uppercase" value="{{$localidad['id']}}">{{$localidad['nombre']}}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="w-1/2">
                <x-form.label for="cityid" :value="__('Direccion')" />
                <x-form.input
                id="direccion"
                wire:model="direccion"
                class="block mt-1 w-full"
                type="text" name="direccion"
                :value="old('direccion')"
                placeholder="Direccion"
            />
            @error('cityid')
                <livewire:mostrar-alerta :message="$message">
            @enderror
        </div>
    </div>

    <hr>

    <div class="text-center">
        <button
        class="py-2 px-3 bg-green-400 rounded font-semibold hover:bg-green-700 cursor-pointer" type="submit"
        >
        Actualizar Paciente
        </button>
    </div>
</form>

@push('sweetalert')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            window.addEventListener('alerta', function(){
                Swal.fire({
                    icon: 'success',
                    title: 'Paciente editado con éxito',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = ' {{ route('pacientes.index') }} ';
                    }
                });
            })
        </script>
@endpush
