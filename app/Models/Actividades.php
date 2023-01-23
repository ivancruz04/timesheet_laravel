<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividades extends Model
{
    use HasFactory;
 
    protected $fillable = ['id_actividad',
                           'nombre_actividad',
                           'descripcion',
                           'fecha_asignacion',
                           'fecha_inicio',
                           'fecha_fin',
                           'fecha_entrega',
                           'id_usuario',
                           'id_equipo',
                           'id_proyecto',
                           'estado',
                           'prioridad'
                           ];
}
