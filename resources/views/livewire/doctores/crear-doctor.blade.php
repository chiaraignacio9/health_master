<form class="w-full space-y-5" autocomplete="off" wire:submit.prevent="guardarDoctor">
    <div class="w-full flex gap-2">
        <div class="w-1/2">
            <x-form.label for="nombre" :value="__('Nombre del doctor')" />
            <x-form.input
                id="nombre"
                wire:model="nombre"
                class="block mt-1 w-full"
                type="text" name="nombre"
                :value="old('nombre')"
                placeholder="Nombre del doctor"
            />

            @error('nombre')
                <livewire:mostrar-alerta :message="$message">
            @enderror

        </div>
        <div class="w-1/2">
            <x-form.label for="apellido" :value="__('Apellido del doctor')" />
            <x-form.input
                id="apellido"
                wire:model="apellido"
                class="block mt-1 w-full"
                type="text" name="apellido"
                :value="old('apellido')"
                placeholder="Apellido del doctor"
            />
            @error('apellido')
                <livewire:mostrar-alerta :message="$message">
            @enderror
        </div>
    </div>

    <div class="w-full">
        <div>
            <select class="w-full text-center" wire:model="especialidad_id" id="especialidad_id">
                <option>-- Seleccione una especialidad --</option>
                @foreach ($especialidades as $especialidad)
                    <option value="{{$especialidad->id}}">{{$especialidad->nombre}}</option>
                @endforeach
            </select>
            @error('especialidad_id')
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
                placeholder="DNI del doctor"
            />
            @error('dni')
                <livewire:mostrar-alerta :message="$message">
            @enderror
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
            @error('provinciaSeleccionada')
                <livewire:mostrar-alerta :message="$message">
            @enderror
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
            @error('departamentoSeleccionado')
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
            @error('localidad')
                <livewire:mostrar-alerta :message="$message">
            @enderror
        </div>
        <div class="w-1/2">
                <x-form.label for="direccion" :value="__('Direccion')" />
                <x-form.input
                id="direccion"
                wire:model="direccion"
                class="block mt-1 w-full"
                type="text" name="direccion"
                :value="old('direccion')"
                placeholder="Direccion"
            />
            @error('direccion')
                <livewire:mostrar-alerta :message="$message">
            @enderror
        </div>
    </div>

    <div class="w-full">
        <div>
            <x-form.label for="image" :value="__('Imagen')" />
            <x-form.input
                id="image"
                wire:model="image"
                class="block mt-1 w-full"
                type="file" name="image"
                accept="image/*"
                :value="old('image')"
            />
        </div>

        <div class="my-5 w-48">
            @if ($image)
                Imagen:
                <img src="{{ $image->temporaryUrl() }}" />
            @endif
        </div>
    </div>

    <hr>

    <div class="text-center">
        <input class="py-2 px-3 bg-green-400 rounded font-semibold" type="submit" value="Crear doctor">
    </div>
</form>
