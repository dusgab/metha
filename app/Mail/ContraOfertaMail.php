<?php

namespace MOHA\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use MOHA\ContraOferta;

class ContraOfertaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $co;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ContraOferta $co)
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
        return $this->view('email.contraOferta')
                    ->from('administrador@metha.gob.ar')
                    ->subject('Nueva Contra Oferta');
    }
}
