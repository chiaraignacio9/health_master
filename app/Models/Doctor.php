<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Doctor extends Model
{
    use HasFactory;

    protected $table = 'doctores';

    protected $fillable = [
        'user_id',
        'especialidad_id'
    ];

    public function getUserData()
    {
        $resultado = DB::select(
            '
            SELECT *
            FROM users
            INNER JOIN doctores
            ON doctores.user_id = users.id
            WHERE users.id = ?
            ',
            [$this->user_id]
        );
        return json_encode($resultado, true);
    }

    public function obtenerEspecialidad()
    {
        $resultado = DB::selectOne(
            '
            SELECT nombre
            FROM doctor_especialidades
            INNER JOIN doctores
            ON doctores.especialidad_id = doctor_especialidades.id
            WHERE doctor_especialidades.id = ?
            ',
            [$this->especialidad_id]
        );

        return $resultado->nombre;
    }
}
