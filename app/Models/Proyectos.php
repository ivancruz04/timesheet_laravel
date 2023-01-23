<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyectos extends Model
{
    use HasFactory;
 
    protected $fillable = ['id',
                           'nombre_proyecto',
                           'fecha_inicio',
                           'fecha_finalizacion',
                           'descripcion',
                           'asignado_a',
                           'estado',
                           'fecha_asignacion'];
}
