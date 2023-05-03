<?php

namespace App\Http\Livewire;

use App\Models\Doctor_especialidad;
use App\Models\Turno;
use DateTime;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CrearTurnos extends Component
{
    public $especialidadSeleccionada;
    public $doctores;
    public $doctor_id;
    public $desde;
    public $hasta;
    public $intervalo;
    public $diasSeleccionados = [
        'sunday' => false,
        'martes' => false,
        'miercoles' => false,
        'jueves' => false,
        'viernes' => false,
    ];
    public function render()
    {
        return view('livewire.crear-turnos', [
            'especialidades' => Doctor_especialidad::all()
        ]);
    }

    public function guardarTurno()
    {
        $desde = date('H:i', strtotime($this->desde));
        $hasta = date('H:i', strtotime($this->hasta));
        $intervalo = date('H:i', strtotime($this->intervalo));
        $diasSeleccionados = collect($this->diasSeleccionados)->filter()->keys()->toArray();

        foreach ($diasSeleccionados as $dia) {
            $dia = new DateTime('next ' . $dia);
            while ($desde < $hasta) {
                Turno::create([
                    'paciente_id' => null,
                    'doctor_id' => $this->doctor_id,
                    'fecha' => $dia->format('Y-m-d'),
                    'hora' => $desde,
                    'estado_id' => 1
                ]);
                $desde = date('H:i', strtotime($desde) + strtotime($intervalo));
            }
        }
    }

    public function actualizarDoctores()
    {
        $response = DB::select('SELECT * FROM doctores INNER JOIN users ON users.rol_id = 2 WHERE doctores.especialidad_id = ?', [$this->especialidadSeleccionada]);
        $this->doctores = json_encode($response);
    }
}
