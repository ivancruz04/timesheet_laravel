<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class correosEquipoNuevo extends Mailable
{
    use Queueable, SerializesModels;

    public $e_nombre_miembro;
    public $e_equipo;
    public $e_descripcion;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($e_nombre_miembro, $e_equipo, $e_descripcion)
    {
        $this->e_nombre_miembro = $e_nombre_miembro;
        $this->e_equipo = $e_equipo;
        $this->e_descripcion = $e_descripcion;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('correos.correo_nuevo_equipo', [
                                                            $this->e_nombre_miembro,
                                                            $this->e_equipo,
                                                            $this->e_descripcion
                                                            ]);
    }
}
