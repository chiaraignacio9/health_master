<?php

namespace App\Http\Livewire\Prepagas;

use App\Models\Prepaga;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EditarPrepaga extends Component
{
    public $nombre;
    public $descuento;

    public $datos;

    protected $rules = [
        'nombre' => 'required',
        'descuento' => 'required'
    ];
    public function render()
    {
        return view('livewire.prepagas.editar-prepaga');
    }

    public function mount($prepaga)
    {
        $this->datos = json_decode($prepaga, true);
        $this->nombre = $this->datos[0]['nombre'];
        $this->descuento = $this->datos[0]['descuento'];
    }

    public function actualizarPrepaga()
    {
        $datos = $this->validate();

        DB::update('UPDATE prepagas SET nombre = ?, descuento = ? WHERE id = ?', [
            $datos['nombre'], $datos['descuento'], $this->datos[0]['id']
        ]);

        $this->dispatchBrowserEvent('alerta');
    }
}
