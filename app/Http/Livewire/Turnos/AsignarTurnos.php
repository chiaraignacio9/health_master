<?php

namespace App\Http\Livewire\Turnos;

use App\Models\Paciente;
use App\Models\Turno;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AsignarTurnos extends Component
{
    public $turno;
    public $fecha;
    public $hora;
    public $turno_id;
    public $dni;
    public $paciente;
    public $nombre;
    public $datosPaciente;
    public function render()
    {
        return view('livewire.turnos.asignar-turnos');
    }

    public function mount($turno)
    {
        $turno = json_decode($turno, true);
        $this->turno = $turno;
        $this->fecha = $turno['fecha'];
        $this->hora = $turno['hora'];
    }

    public function buscarPaciente()
    {
        $paciente = User::where('dni', $this->dni)
            ->where('rol_id', 3)
            ->first();

        if ($paciente) {
            $this->nombre = $paciente->nombre . ' ' . $paciente->apellido;
            $this->paciente = $paciente;
            $this->datosPaciente = json_encode(DB::selectOne('SELECT id FROM pacientes WHERE user_id = ?', [$paciente->id]));
        } else {
            $this->nombre = 'Ingrese DNI para buscar paciente';
        }
    }

    public function asignarTurno()
    {
        DB::update('UPDATE turnos SET paciente_id = ?, estado_id = 2 where id = ?', [
            json_decode($this->datosPaciente, true)['id'],
            $this->turno['id']
        ]);
        session()->flash('mensaje', 'Turno asignado correctamente');
        return redirect()->route('turnos.index');
    }
}
