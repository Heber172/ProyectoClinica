<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class CorreoPacienteCuenta extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Acceso al Sistema de Gestión de Pacientes';

    public $msg;

    public $email;
    public $email_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $transport = (new \Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
                        ->setUsername($data['usuario'])
                        ->setPassword($data['pass']);

        $mailer = new \Swift_Mailer($transport);

        \Mail::setSwiftMailer($mailer);

        $this->msg  = $data;

        $this->email      = $data['usuario'];
        $this->email_name = $data['email_name'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->email, $this->email_name)
                    ->view('mail.paciente_cuenta');
    }
}
