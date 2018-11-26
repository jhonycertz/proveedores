<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class QuestionMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public $data;
    public function __construct($data)
    {
      // dd($type);
        $this->data = $data;
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
                    ->subject('Ha recibido una nueva pregunta')
                    ->view('mails.new_question')                    
                    ->with(['data' => $this->data]);
    }
}
