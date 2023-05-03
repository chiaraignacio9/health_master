<?php

namespace App\Http\Livewire;

use App\Models\Paciente;
use App\Models\Prepaga;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class EditarPaciente extends Component
{
    public $nombre;
    public $apellido;
    public $direccion;
    public $dni;
    public $nacimiento;
    public $email;
    public $id_prepaga;
    public $numero_afiliado;
    public $localidad;

    public $provincias;
    public $provinciaSeleccionada;
    public $departamentoSeleccionado;
    public $departamentos;
    public $localidades;
    public $datos;
    public $user_id;
    protected $rules = [
        'nombre' => 'required',
        'apellido' => 'required',
        'direccion' => 'required',
        'dni' => 'required',
        'nacimiento' => 'required|date',
        'provinciaSeleccionada' => 'required',
        'departamentoSeleccionado' => 'required',
        'localidad' => 'required',
        'email' => 'required|email'
    ];

    protected $messages = [
        'nombre.required' => 'El nombre es obligatorio',
        'apellido.required' => 'El apellido es obligatorio'
    ];
    public function render()
    {
        return view('livewire.editar-paciente', [
            'prepagas' => Prepaga::all()
        ]);
    }

    public function actualizarPaciente()
    {
        $datos = $this->validate();
        DB::update(
            'UPDATE users SET
                nombre = ?,
                apellido = ?,
                direccion = ?,
                dni = ?,
                nacimiento = ?,
                provincia_id = ?,
                departamento_id = ?,
                localidad_id = ?,
                email = ?,
                password = ?,
                updated_at = ?
                WHERE users.id = ?
            ',
            [
                $datos['nombre'],
                $datos['apellido'],
                $datos['direccion'],
                $datos['dni'],
                $datos['nacimiento'],
                $datos['provinciaSeleccionada'],
                $datos['departamentoSeleccionado'],
                $datos['localidad'],
                $datos['email'],
                Hash::make($datos['dni']),
                date('Y-m-d H:i:s'),
                $this->datos['user_id']
            ]
        );

        DB::update('UPDATE pacientes SET
        prepaga_id = ?, numero_afiliado = ?
        WHERE id = ?', [
            $this->id_prepaga,
            $this->numero_afiliado,
            $this->datos['paciente_id']
        ]);

        session()->flash('mensaje', 'Paciente editado exitosamente');
        return redirect()->route('pacientes.index');
    }

    public function mount($paciente)
    {
        $this->provincias = $this->obtenerProvincias();

        $this->datos = json_decode($paciente, true);
        $this->nombre = $this->datos['nombre'];
        $this->apellido = $this->datos['apellido'];
        $this->email = $this->datos['email'];
        $this->dni = $this->datos['dni'];
        $this->nacimiento = $this->datos['nacimiento'];
        $this->id_prepaga = $this->datos['prepaga_id'];
        $this->numero_afiliado = $this->datos['numero_afiliado'];
        $this->provinciaSeleccionada = $this->datos['provincia_id'];
        $this->departamentoSeleccionado = $this->datos['departamento_id'];
        $this->actualizarDepartamentos();
        $this->localidad = $this->datos['localidad_id'];
        $this->actualizarLocalidades();
        $this->direccion = $this->datos['direccion'];
    }

    public function obtenerProvincias()
    {
        $response = Http::withOptions(['verify' => false])->get('https://apis.datos.gob.ar/georef/api/provincias?campos=id,nombre');
        if ($response->ok()) {
            $provincias = $response['provincias'];
            $provinciasFormateadas = [];
            foreach ($provincias as $provincia) {
                $provinciasFormateadas[] = [
                    'id' => $provincia['id'],
                    'nombre' => $provincia['nombre']
                ];
            }
        }
        return $provinciasFormateadas;
    }

    public function obtenerDepartamentos($provincia)
    {
        $response = Http::withOptions(['verify' => false])->get('https://apis.datos.gob.ar/georef/api/departamentos?provincia=' . $provincia . '&campos=id,nombre&max=5000');
        $departamentos = $response['departamentos'];
        $departamentosFormateados = [];
        foreach ($departamentos as $departamento) {
            $departamentosFormateados[] = [
                'id' => $departamento['id'],
                'nombre' => $departamento['nombre']
            ];
        }
        $this->departamentos = $departamentosFormateados;
    }

    public function obtenerLocalidades($provincia, $departamento)
    {
        $response = Http::withOptions(['verify' => false])->get('https://apis.datos.gob.ar/georef/api/localidades?departamento=' . $departamento . '&provincia=' . $provincia . '&max=5000');
        $localidades = $response['localidades'];
        $localidadesFormateadas = [];
        foreach ($localidades as $localidad) {
            $localidadesFormateadas[] = [
                'id' => $localidad['id'],
                'nombre' => $localidad['nombre']
            ];
        }
        $this->localidades = $localidadesFormateadas;
    }

    public function actualizarDepartamentos()
    {
        $this->obtenerDepartamentos($this->provinciaSeleccionada);
    }

    public function actualizarLocalidades()
    {
        $this->obtenerLocalidades($this->provinciaSeleccionada, $this->departamentoSeleccionado);
    }
}
