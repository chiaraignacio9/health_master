<?php

namespace App\Http\Livewire\Prepagas;

use App\Models\Prepaga;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ListarPrepagas extends Component
{
    public function render()
    {
        return view('livewire.prepagas.listar-prepagas', [
            'prepagas' => Prepaga::where('flag_id', 1)->get()
        ]);
    }

    public function eliminarPrepaga($id)
    {
        DB::update("UPDATE prepagas SET flag_id = 2 WHERE id = ?", [$id]);
    }
}
