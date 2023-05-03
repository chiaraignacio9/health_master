<?php

namespace App\Http\Livewire;

use App\Models\Prepaga;
use Livewire\Component;

class CrearPrepaga extends Component
{

    public $nombre;
    public $descuento;


    protected $rules = [
        'nombre' => 'required',
        'descuento' => 'required'
    ];
    public function render()
    {
        return view('livewire.crear-prepaga');
    }

    public function guardarPrepaga()
    {
        $datos = $this->validate();

        Prepaga::create([
            'nombre' => $datos['nombre'],
            'descuento' => $datos['descuento'],
        ]);

        session()->flash('mensaje', 'Prepaga creada con éxito');
        return redirect()->route('prepagas.index');
    }
}
