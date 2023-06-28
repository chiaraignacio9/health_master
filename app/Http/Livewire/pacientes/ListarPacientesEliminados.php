<?php

namespace App\Http\Livewire\Pacientes;

use App\Models\Paciente;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ListarPacientesEliminados extends Component
{

    protected $listeners = [
        'restaurarPaciente'
    ];

    public function restaurarPaciente($paciente)
    {
        DB::update("UPDATE pacientes SET flag_id = 1 WHERE id = ?", [$paciente['id']]);
        DB::update("UPDATE users SET flag_id = 1, updated_at = ? WHERE id = ?", [$paciente['user_id'], date('yyyy-m-d')]);
    }
    public function render()
    {
        return view('livewire.pacientes.listar-pacientes-eliminados', [
            'pacientes' => Paciente::where('flag_id', 2)->get()
        ]);
    }
}
