<?php

namespace App\Http\Livewire;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ListarDoctores extends Component
{
    public function render()
    {
        return view('livewire.listar-doctores', [
            'doctores' => Doctor::all()
        ]);
    }
}
