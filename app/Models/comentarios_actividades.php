<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comentarios_actividades extends Model
{
    use HasFactory;

    protected $fillable = ['id_comentario',
                           'id_actividad',
                           'id_usuario',
                           'descripcion',
                           'fecha',
                           'hora'];
}
