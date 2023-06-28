<?php

namespace App\Http\Livewire\Doctores;

use App\Models\Doctor;
use App\Models\Doctor_especialidad;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithFileUploads;

class CrearDoctor extends Component
{
    public $nombre;
    public $apellido;
    public $direccion;
    public $dni;
    public $nacimiento;
    public $email;
    public $localidad;

    public $provincias;
    public $provinciaSeleccionada;
    public $departamentoSeleccionado;
    public $departamentos;
    public $localidades;
    public $especialidad_id;

    public $image;

    use WithFileUploads;
    protected $rules = [
        'nombre' => 'required',
        'apellido' => 'required',
        'direccion' => 'required',
        'dni' => 'required',
        'nacimiento' => 'required|date',
        'provinciaSeleccionada' => 'required',
        'departamentoSeleccionado' => 'required',
        'localidad' => 'required',
        'email' => 'required|email',
        'especialidad_id' => 'required',
        'image' => 'image|max:1024'
    ];

    protected $messages = [
        'nombre.required' => 'El nombre es obligatorio',
        'apellido.required' => 'El apellido es obligatorio'
    ];

    public function guardarDoctor()
    {
        $datos = $this->validate();

        $image = $this->image->store('public/imagenes');
        $path = str_replace('public/imagenes/', '', $image);

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
            'rol_id' => 2,
            'flag_id' => 1,
        ]);

        Doctor::create([
            'user_id' => $usuario->id,
            'especialidad_id' => $this->especialidad_id,
            'image_path' => $path
        ]);

        session()->flash('mensaje', 'Doctor creado exitosamente');
        return redirect()->route('doctores.index');
    }
    public function render()
    {
        return view('livewire.doctores.crear-doctor', [
            'especialidades' => Doctor_especialidad::all()
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
