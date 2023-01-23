<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class correosProyectosEquipo extends Mailable
{
    use Queueable, SerializesModels;

    public $nombre_usuario;
    public $nombreProyecto;
    public $descripcionProyecto;
    public $asigProyecto;
    public $finProyecto;
    public $nombre_equipo;
    public $nombre_proyecto;
    


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nombreProyecto, $descripcionProyecto, $asigProyecto, $finProyecto, $nombre_usuario, $nombre_equipo, $nombre_proyecto)
    {
        $this->nombreProyecto = $nombreProyecto;
        $this->descripcionProyecto = $descripcionProyecto;
        $this->asigProyecto = $asigProyecto;
        $this->finProyecto = $finProyecto;
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
        return $this->view('correos.correo_proyectos_equipo', [
                                                            $this->nombreProyecto,
                                                            $this->descripcionProyecto,
                                                            $this->asigProyecto,
                                                            $this->finProyecto,
                                                            $this->nombre_usuario,
                                                            $this->nombre_equipo,
                                                            $this->nombre_proyecto] );
    }
}
