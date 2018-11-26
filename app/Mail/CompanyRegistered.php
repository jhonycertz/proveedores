<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CompanyRegistered extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public $type;
     public $view;
     public $subject;
     public $data;
    public function __construct($type, $data)
    {
      // dd($type);
        $this->type = $type;
        $this->data = $data;
        if ($this->type == 'admin') {
            $this->view = 'mails.user_registered_admin';
            $this->subject = 'Se ha registrado un aspirante!';
        } else {
            $this->view = 'mails.user_registered';
            $this->subject = 'Se ha registrado exitosamente!';
        }

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(getenv('MAIL_USERNAME'), getenv('MAIL_NAME'))
                    ->bcc('KraftHeinzVzlaProveedores@gmail.com')
                    ->subject($this->subject)
                    ->view($this->view)                    
                    ->with(['data' => $this->data]);
    }
}
