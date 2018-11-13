<?php

namespace MOHA\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use MOHA\Contraoferta;
use MOHA\User;

class ProductosRecibidosMail extends Mailable
{
    use Queueable, SerializesModels;

    public $co;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ContraOferta $co, User $user)
    {
        $this->co = $co;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.productosRecibidos')
                    ->from('no-contestar@corrientes.gov.ar')
                    ->subject('Productos Recibidos');
    }
}
