<?php

namespace App\Http\Livewire;

use App\Models\Paciente;
use App\Models\Patient;
use Livewire\Component;

class ListarPacientes extends Component
{
    public function render()
    {
        return view('livewire.listar-pacientes', [
            'pacientes' => Paciente::all()
        ]);
    }
}
