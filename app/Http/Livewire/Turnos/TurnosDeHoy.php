<?php

namespace App\Http\Livewire\Turnos;

use App\Models\Turno;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TurnosDeHoy extends Component
{
    public function render()
    {

        return view('livewire.turnos.turnos-de-hoy', [
            'turnos' => DB::select(
                'SELECT turnos.*, pacientes.*, doctores.*, users.*, turnos.id as idTurno
                FROM turnos
                INNER JOIN pacientes ON turnos.paciente_id = pacientes.id
                INNER JOIN doctores ON doctores.user_id = ?
                INNER JOIN users ON users.id = pacientes.user_id
                WHERE turnos.estado_id = 2
                AND turnos.fecha = DATE(NOW())
                AND turnos.doctor_id = (SELECT doctores.id FROM doctores WHERE doctores.user_id = ?)
            ',
                [
                    10,
                    10,
                ]
            )
        ]);
    }
}
