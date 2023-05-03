<div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        @if (Auth::user()->rol_id == 1)
        <a class="py-2 px-3 bg-cyan-200 font-semibold rounded text-center" href="{{ route('turnos.create') }}">Crear Turno</a>
        @endif

            <div class="w-full flex gap-2">
                <div class="w-1/2">
                    <select
                        id="especialidad"
                        wire:model="especialidadSeleccionada"
                        class="block mt-1 w-full text-center"
                        type="text" name="especialidad"
                        wire:change="actualizarDoctores"
                    >
                    <option>-- Seleccione especialidad --</option>
                    @foreach ($especialidades as $especialidad)
                        <option value="{{$especialidad->id}}">{{$especialidad->nombre}}</option>
                    @endforeach
                    </select>
                </div>
                <div class="w-1/2">
                    <select
                        id="doctorSeleccionado"
                        wire:model="doctorSeleccionado"
                        class="block mt-1 w-full text-center"
                        type="text" name="doctorSeleccionado"
                        wire:change="actualizarTurnos"
                    >
                    <option>-- Seleccione doctor --</option>
                    @if ($doctores)
                        @php
                            $doctoresDatos = json_decode($doctores, true);
                        @endphp
                        @foreach ($doctoresDatos as $doctor)
                            <option value="{{$doctor['id']}}">{{$doctor['nombre'] . ' ' . $doctor['apellido']}}</option>
                        @endforeach
                    @endif
                    </select>
                </div>
            </div>
            <hr class="font-bold">
            @if ($turnos)
                @php
                    $turnosDatos = json_decode($turnos, true);
                @endphp
                @foreach ($turnosDatos as $turno)
                <div class="p-6 text-gray-900 border-b md:flex md:justify-between md:items-center">
                    <div class="leading-10">
                        <a href="" class="text-base font-bold">
                            Fecha: {{ $turno['fecha'] }} - Hora: {{ $turno['hora'] }}
                        </a>
                        <p class="text-sm text-gray-500 ">

                        </p>
                    </div>
                    @if (Auth::user()->rol_id == 1)
                    <div class="flex flex-col items-stretch md:flex-row gap-3 text-center mt-5 md:mt-0">
                        @if ($turno['estado_id'] == 2)
                            <a
                                href=""
                                class="bg-yellow-400 py-2 px-4 roundedz text-black text-xs font-bold uppercase"
                            >Ver paciente asignado</a>
                        @elseif ($turno['estado_id'] == 1)
                            <a
                                href="{{route('turnos.show', ['turno' => $turno['id'] ])}}"
                                class="bg-green-400 py-2 px-4 rounded text-black text-xs font-bold uppercase"
                            >Asignar a Paciente</a>
                        @endif

                        <a
                            href="#"
                            class="bg-red-600 py-2 px-4 rounded text-white text-xs font-bold uppercase"
                        >Eliminar</a>
                    </div>

                    @elseif (Auth::user()->rol_id == 3)
                        @if ($turno['estado_id'] == 1)
                            <a
                                wire:click="tomarTurno('{{$turno['id']}}', {{ Auth::user()->id }})"
                                class="bg-green-400 py-2 px-4 rounded text-black text-xs font-bold uppercase cursor-pointer hover:bg-green-200"
                                >Tomar turno
                            </a>
                        @endif
                    @endif

                </div>
                @endforeach
            @endif
    </div>
</div>