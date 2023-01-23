<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class correosProyectos extends Mailable
{
    use Queueable, SerializesModels;

    public $nombre_usuario;
    public $nombreProyecto;
    public $descripcionProyecto;
    public $asigProyecto;
    public $finProyecto;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nombreProyecto, $descripcionProyecto, $asigProyecto, $finProyecto, $nombre_usuario)
    {
        $this->nombreProyecto = $nombreProyecto;
        $this->descripcionProyecto = $descripcionProyecto;
        $this->asigProyecto = $asigProyecto;
        $this->finProyecto = $finProyecto;
        $this->nombre_usuario = $nombre_usuario;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('correos.correo_proyectos', [
                                                            $this->nombreProyecto,
                                                            $this->descripcionProyecto,
                                                            $this->asigProyecto,
                                                            $this->finProyecto,
                                                            $this->nombre_usuario] );
    }
}
