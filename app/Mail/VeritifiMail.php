<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VeritifiMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $datas;
    public function __construct($ids)
    {
        $this->datas  = $ids;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $dt = $this->datas;
        return $this->view('blank.signup',compact('dt'));
    }
}
