<?php

namespace App\Http\Livewire\Doctores;

use App\Models\Doctor_especialidad;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditarDoctor extends Component
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
    public $prevImage;
    public $datos;

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
    ];

    protected $messages = [
        'nombre.required' => 'El nombre es obligatorio',
        'apellido.required' => 'El apellido es obligatorio'
    ];
    public function render()
    {
        return view('livewire.doctores.editar-doctor', [
            'especialidades' => Doctor_especialidad::all()
        ]);
    }

    public function actualizarDoctor()
    {
        //dd($this->datos);

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

        DB::update('UPDATE doctores SET
        especialidad_id = ?
        WHERE id = ?', [
            $this->especialidad_id,
            $this->datos['doctor_id']
        ]);

        $this->dispatchBrowserEvent('alerta');
    }

    public function mount($doctor)
    {

        $this->datos = json_decode($doctor, true);

        $this->nombre = $this->datos['nombre'];
        $this->apellido = $this->datos['apellido'];
        $this->direccion = $this->datos['direccion'];
        $this->dni = $this->datos['dni'];
        $this->nacimiento = $this->datos['nacimiento'];
        $this->email = $this->datos['email'];
        $this->especialidad_id = $this->datos['especialidad_id'];

        $this->provinciaSeleccionada = $this->datos['provincia_id'];
        $this->departamentoSeleccionado = $this->datos['departamento_id'];
        $this->actualizarDepartamentos();
        $this->localidad = $this->datos['localidad_id'];
        $this->actualizarLocalidades();

        $this->prevImage = $this->datos['image_path'];

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
