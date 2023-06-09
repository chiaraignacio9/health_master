<?php

namespace App\Http\Livewire\Turnos;

use App\Models\Turno;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class HistorialTurnos extends Component
{
    public function render()
    {
        return view('livewire.turnos.historial-turnos', [
            'turnos' => DB::select(
                'SELECT turnos.*, turnos_estados.*, turnos_estados.estado AS estado
            FROM turnos INNER JOIN turnos_estados ON turnos_estados.id = turnos.estado_id
            WHERE paciente_id = (SELECT id FROM pacientes WHERE user_id = ?) ',
                [
                    Auth::user()->id,
                ]
            )
        ]);
    }
}
