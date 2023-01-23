<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Puestos;
use Illuminate\Support\Facades\DB; //referencia para hacer operaciones con la clase DB 


//spatie

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable. 
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id_puesto'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //funcion para que coloque la imagen en el icono de perfil
    public function adminlte_image(){


        // "{{ asset('/img/usuario2.png') }}"
        $image = "/img/usuario2.png";
        return $image;

    }

    //funcion para que muestre el rol debajo del nombre
    public function adminlte_desc(){
        $quien = $this->id_puesto;
        $puestos = DB::table('puestos')
                ->select('descripcion')
                ->where('id_puesto', '=', $this->id_puesto)
                ->get();
        
        foreach($puestos as $puesto){
            return $puesto->descripcion;
        }
        
    }

    public function adminlte_profile_url(){
        
    }
}