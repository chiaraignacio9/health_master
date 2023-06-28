<?php

namespace App\Http\Livewire\Pacientes;

use App\Models\City;
use App\Models\Health_insurance;
use App\Models\Paciente;
use App\Models\Prepaga;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class CrearPaciente extends Component
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

    public function storePatient()
    {
        $datos = $this->validate();

        $usuario = User::create([
            'nombre' => $datos['nombre'],
            'apellido' => $datos['apellido'],
            'direccion' => $datos['direccion'],
            'dni' => $datos['dni'],
            'nacimiento' => $datos['nacimiento'],
            'provincia_id' => $datos['provinciaSeleccionada'],
            'departamento_id' => $datos['departamentoSeleccionado'],
            'localidad_id' => $datos['localidad'],
            'email' => $datos['email'],
            'password' => Hash::make($datos['dni']),
            'rol_id' => 3,
            'flag_id' => 1,
        ]);

        Paciente::create([
            'user_id' => $usuario->id,
            'prepaga_id' => 1,
            'numero_afiliado' => 1
        ]);

        session()->flash('mensaje', 'Paciente creado exitosamente');
        return redirect()->route('pacientes.index');
    }



    public function render()
    {
        return view('livewire.pacientes.crear-paciente', [
            'prepagas' => Prepaga::all()
        ]);
    }

    public function mount()
    {
        $this->provincias = $this->obtenerProvincias();
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
