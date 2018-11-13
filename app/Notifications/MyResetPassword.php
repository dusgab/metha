<?php

namespace MOHA\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class MyResetPassword extends ResetPassword
{

    public function toMail($notifiable)
    {   
        
        return (new MailMessage)
            ->subject('Recuperar Contraseña')
            ->greeting('Hola ')
            ->line('Estas recibiendo este correo electrónico porque hiciste una solicitud para recuperar tu contraseña.')
            ->action('Recuperar contraseña', route('password.reset', $this->token))
            ->line('Si no realizaste esta solicitud, no se requiere realizar ninguna otra accion')
            ->salutation('Saludos!');
    }
}
