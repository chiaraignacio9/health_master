<?php

namespace App\Http\Livewire;

use App\Models\Turno;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TurnosDeHoy extends Component
{
    public function render()
    {

        return view('livewire.turnos-de-hoy', [
            'turnos' => DB::select(
                'SELECT turnos.*, pacientes.*, doctores.*, users.*
                FROM turnos
                INNER JOIN pacientes ON turnos.paciente_id = pacientes.id
                INNER JOIN doctores ON doctores.user_id = ?
                INNER JOIN users ON users.id = pacientes.user_id
                WHERE turnos.estado_id = 2
                AND turnos.doctor_id = (SELECT doctores.id FROM doctores WHERE doctores.user_id = ?)
                AND turnos.fecha = ?
            ',
                [
                    Auth::user()->id,
                    " '" . date('Y-m-d') . "'",
                    Auth::user()->id,
                ]
            )
        ]);
    }
}
