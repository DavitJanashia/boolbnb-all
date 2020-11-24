<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageSend extends Mailable
{
    use Queueable, SerializesModels;


    public $msg;
    public $apart;
    public $action;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($msg,$apart,$action)
    {
      $this -> msg = $msg;
      $this -> apart = $apart;
      $this -> action = $action;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this-> from('boolbnb.messages@gmail.com')
                  ->   view('message-email');
    }
}
