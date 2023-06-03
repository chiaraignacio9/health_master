<form class="w-full space-y-5" autocomplete="off" wire:submit.prevent="guardarTurno">

    <div class="w-full flex gap-2">
        <div class="w-1/2">
            <x-form.label for="nombre" :value="__('Especialidad')" />
            <select
                wire:change="actualizarDoctores"
                id="especialidad"
                wire:model="especialidadSeleccionada"
                class="block mt-1 w-full text-center"
                type="text" name="especialidad"
                :value="old('especialidad')"
            >
            <option>-- Seleccione la especialidad del doctor</option>
            @foreach ($especialidades as $especialidad)
                <option value="{{$especialidad->id}}">{{$especialidad->nombre}}</option>
            @endforeach
            </select>
        </div>
        <div class="w-1/2">
            <x-form.label for="doctor_id" :value="__('Doctor')" />
            <select
                id="doctor_id"
                wire:model="doctor_id"
                class="block mt-1 w-full text-center"
                type="text" name="doctor_id"
                :value="old('doctor_id')"
            >
            <option>-- Seleccione el doctor</option>
            @if ($doctores)
            @php
                $doctoresDatos = json_decode($doctores, true);
                var_dump($doctores);
            @endphp
                @foreach ($doctoresDatos as $doctor)
                    <option value="{{$doctor['doctor_id']}}">{{$doctor['nombre'] . ' ' . $doctor['apellido']}}</option>
                @endforeach
            @endif
            </select>
        </div>
    </div>

    <div>
        <x-form.label for="dias" :value="__('Dias')" />
        <label>
            <input type="checkbox" wire:model="diasSeleccionados.monday">
            Lunes
        </label>

        <label>
            <input type="checkbox" wire:model="diasSeleccionados.tuesday">
            Martes
        </label>

        <label>
            <input type="checkbox" wire:model="diasSeleccionados.wednesday">
            Miércoles
        </label>

        <label>
            <input type="checkbox" wire:model="diasSeleccionados.thursday">
            Jueves
        </label>

        <label>
            <input type="checkbox" wire:model="diasSeleccionados.friday">
            Viernes
        </label>
    </div>

    <label for="desde">Desde:</label> <input type="time" wire:model="desde" id="desde">
    <label for="hasta">Hasta:</label> <input type="time" wire:model="hasta" id="hasta">
    <label for="intervaloi">Espacio entre turnos:</label> <input type="time" wire:model="intervalo" id="intervalo">

    <hr>

    <div class="text-center">
        <input class="cursor-pointer hover:bg-green-700 hover:text-white py-2 px-3 bg-green-400 rounded font-semibold" type="submit" value="Crear turnos">
    </div>
</form>
