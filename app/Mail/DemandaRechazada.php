<?php

namespace MOHA\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use MOHA\Contrademanda;

class DemandaRechazada extends Mailable
{
    use Queueable, SerializesModels;

    public $cd;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Contrademanda $cd)
    {
        $this->cd = $cd;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.demandaRechazada')
                    ->from('administrador@metha.gob.ar')
                    ->subject('Contra Demanda Rechazada');
    }
}
