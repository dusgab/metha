<?php

namespace MOHA\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use MOHA\User;
use MOHA\Contraoferta;

class OfertaAceptada extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $co;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Contraoferta $co)
    {
        $this->user = $user;
        $this->co = $co;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.ofertaAceptada')
                    ->from('no-contestar@corrientes.gov.ar')
                    ->subject('Contra Oferta Aceptada');
    }
}
