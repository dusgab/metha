<?php

namespace MOHA\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use MOHA\Contraoferta;

class OfertaRechazada extends Mailable
{
    use Queueable, SerializesModels;

    public $co;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Contraoferta $co)
    {
        $this->co = $co;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.ofertaRechazada')
                    ->from('no-contestar@corrientes.gov.ar')
                    ->subject('Contra Oferta Rechazada');
    }
}
