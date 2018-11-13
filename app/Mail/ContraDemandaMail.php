<?php

namespace MOHA\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use MOHA\ContraDemanda;

class ContraDemandaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $cd;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ContraDemanda $cd)
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
        return $this->view('email.contraDemanda')
                    ->from('no-contestar@corrientes.gov.ar')
                    ->subject('Nueva Contra Demanda');
    }
}
