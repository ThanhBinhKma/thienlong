<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CodeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $datasss;
    public function __construct($datass)  
    {
        $this->datasss = $datass;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $dt = $this->datasss;
        return $this->view('mail.code',compact('dt'));
    }
}
