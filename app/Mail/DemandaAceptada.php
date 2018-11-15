<?php

namespace MOHA\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use MOHA\User;
use MOHA\Contrademanda;

class DemandaAceptada extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $cd;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Contrademanda $cd)
    {
        $this->user = $user;
        $this->cd = $cd;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.demandaAceptada')
                    ->from('administrador@metha.gob.ar')
                    ->subject('Contra Demanda Aceptada');
    }
}
