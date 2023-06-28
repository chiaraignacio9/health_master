<?php

namespace App\Http\Livewire\Pacientes;

use App\Models\Paciente;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ListarPacientes extends Component
{

    protected $listeners = [
        'eliminarPaciente'
    ];

    public function eliminarPaciente($paciente)
    {
        DB::update("UPDATE pacientes SET flag_id = 2 WHERE id = ?", [$paciente['id']]);
        DB::update("UPDATE users SET flag_id = 2 WHERE id = ?", [$paciente['user_id']]);
    }
    public function render()
    {
        return view('livewire.pacientes.listar-pacientes', [
            'pacientes' => Paciente::where('flag_id', 1)->get()
        ]);
    }
}
