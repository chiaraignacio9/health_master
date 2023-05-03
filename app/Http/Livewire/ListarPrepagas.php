<?php

namespace App\Http\Livewire;

use App\Models\Prepaga;
use Livewire\Component;

class ListarPrepagas extends Component
{
    public function render()
    {
        return view('livewire.listar-prepagas', [
            'prepagas' => Prepaga::all()
        ]);
    }
}
