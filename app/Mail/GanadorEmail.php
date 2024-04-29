<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class GanadorEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $ganador;

    public function __construct($ganador)
    {
        $this->ganador = $ganador;
    }

    public function build()
    {
        return $this->view('ganador')
                    ->with(['ganador' => $this->ganador]);
    }
}
