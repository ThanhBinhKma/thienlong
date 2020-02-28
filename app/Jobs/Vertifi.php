<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Mail\VeritifiMail;
class Vertifi implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */ 
    private $id ;
    public function __construct($data)
    {
        $this->id = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {   
            $datass = $this->id;
            Mail::to(base64_decode($datass['email']))->send(new VeritifiMail($datass));
       
    }
}
