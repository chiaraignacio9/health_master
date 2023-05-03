<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'prepaga_id',
        'numero_afiliado',
        'utlima_consulta'
    ];

    public function getUserData()
    {
        $resultado = DB::select(
            '
            SELECT *
            FROM users
            INNER JOIN pacientes
            ON pacientes.user_id = users.id
            WHERE users.id = ?
            ',
            [$this->user_id]
        );
        return json_encode($resultado, true);
    }
}
