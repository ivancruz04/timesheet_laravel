<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class correosActividades extends Mailable
{
    use Queueable, SerializesModels;

    public $nombre_usuario;
    public $nombreActividad;
    public $descripcionActividad;
    public $asigActividad;
    public $finActividad;

    /** 
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nombreActividad, $descripcionActividad, $asigActividad, $finActividad, $nombre_usuario)
    {
        $this->nombreActividad = $nombreActividad;
        $this->descripcionActividad = $descripcionActividad;
        $this->asigActividad = $asigActividad;
        $this->finActividad = $finActividad;
        $this->nombre_usuario = $nombre_usuario;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('correos.correo_actividades', [
                                                            $this->nombreActividad,
                                                            $this->descripcionActividad,
                                                            $this->asigActividad,
                                                            $this->finActividad,
                                                            $this->nombre_usuario] );
    }
}
