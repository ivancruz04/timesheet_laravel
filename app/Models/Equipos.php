<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipos extends Model 
{
    use HasFactory; 

    protected $fillable = ['id_equipo',
                           'nombre_equipo',
                           'descripcion',
                           'id_usuario'];
} 
