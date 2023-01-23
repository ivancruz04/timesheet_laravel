<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class correosActividadesEquipo extends Mailable
{
    use Queueable, SerializesModels;

    public $nombre_usuario;
    public $nombreActividad;
    public $descripcionActividad;
    public $asigActividad;
    public $finActividad;
    public $nombre_equipo;
    public $nombre_proyecto;
    


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nombreActividad, $descripcionActividad, $asigActividad, $finActividad, $nombre_usuario, $nombre_equipo, $nombre_proyecto)
    {
        $this->nombreActividad = $nombreActividad;
        $this->descripcionActividad = $descripcionActividad;
        $this->asigActividad = $asigActividad;
        $this->finActividad = $finActividad;
        $this->nombre_usuario = $nombre_usuario;
        $this->nombre_equipo = $nombre_equipo;
        $this->nombre_proyecto = $nombre_proyecto;

    }

    /** 
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('correos.correo_actividades_equipo', [
                                                            $this->nombreActividad,
                                                            $this->descripcionActividad,
                                                            $this->asigActividad,
                                                            $this->finActividad,
                                                            $this->nombre_usuario,
                                                            $this->nombre_equipo,
                                                            $this->nombre_proyecto] );
    }
}
