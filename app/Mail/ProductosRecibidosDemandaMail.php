<?php

namespace MOHA\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use MOHA\Contrademanda;
use MOHA\User;

class ProductosRecibidosDemandaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $cd;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Contrademanda $cd, User $user)
    {
        $this->cd = $cd;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.productosRecibidosDemanda')
                    ->from('administrador@metha.gob.ar')
                    ->subject('Productos Recibidos');
    }
}
