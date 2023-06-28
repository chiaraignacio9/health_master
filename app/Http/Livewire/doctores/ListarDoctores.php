<?php

namespace App\Http\Livewire\Doctores;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ListarDoctores extends Component
{

    protected $listeners = [
        'eliminarDoctor'
    ];

    public function eliminarDoctor($id)
    {
        DB::update("UPDATE doctores SET flag_id = 2 WHERE id = ?", [$id]);
        DB::update("UPDATE users SET flag_id = 2 WHERE id = ?", [$id]);
    }
    public function render()
    {
        return view('livewire.doctores.listar-doctores', [
            'doctores' => DB::select('SELECT doctor_especialidades.*, users.*, doctores.*, doctor_especialidades.nombre AS especialidad FROM doctores
            INNER JOIN users ON doctores.user_id = users.id
            INNER JOIN doctor_especialidades ON doctores.especialidad_id = doctor_especialidades.id
            WHERE doctores.flag_id = 1')
        ]);
    }
}
