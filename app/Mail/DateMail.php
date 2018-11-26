<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DateMail extends Mailable
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
      // dd($data);
      $this->data = $data;

      // dd($this->contactpax);

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
                    ->subject('Hemos pautado una cita con su empresa')
                    ->view('mails.new_date')                    
                    ->with(['data' => $this->data]);
    }
}
