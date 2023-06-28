<?php

namespace App\Http\Livewire\Turnos;

use App\Models\Doctor_especialidad;
use App\Models\Paciente;
use App\Models\Turno;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ListarTurnos extends Component
{

    public $turnos;
    public $doctores;
    public $especialidadSeleccionada;
    public $doctorSeleccionado;

    public function render()
    {
        return view('livewire.turnos.listar-turnos', [
            'especialidades' => Doctor_especialidad::all()
        ]);
    }

    public function actualizarDoctores()
    {
        $response = DB::select(
            'SELECT users.*,doctores.*, doctores.id AS doctor_id FROM doctores INNER JOIN users ON users.rol_id = 2
        WHERE doctores.especialidad_id = ? AND users.id = doctores.user_id',
            [$this->especialidadSeleccionada]
        );
        $this->doctores = json_encode($response);
    }

    public function actualizarTurnos()
    {

        $fechaHoy = date('Y-m-d');

        if (Auth::user()->rol_id == 3) {
            $response = DB::select(
                'SELECT * FROM turnos
                                WHERE doctor_id = ?
                                AND estado_id = 1
                                AND fecha >= ?',
                [
                    $this->doctorSeleccionado,
                    $fechaHoy
                ]
            );
        } else if (Auth::user()->rol_id == 1) {
            $response = DB::select(
                'SELECT * FROM turnos
                                    WHERE doctor_id = ?
                                    AND (estado_id = 1 OR estado_id = 2)
                                    AND fecha >= ?',
                [
                    $this->doctorSeleccionado,
                    $fechaHoy
                ]
            );
        }

        $this->turnos = json_encode($response);
    }

    public function tomarTurno($id, $user_id)
    {
        $datosPaciente = json_encode(DB::selectOne('SELECT * FROM pacientes WHERE user_id = ?', [$user_id]));
        $datosPaciente = json_decode($datosPaciente, true);
        DB::update('UPDATE turnos SET paciente_id = ?, estado_id = 2 where id = ?', [
            $datosPaciente['id'],
            $id
        ]);

        session()->flash('mensaje', 'Turno reservado correctamente');
        return redirect()->route('dashboard');
    }
}
