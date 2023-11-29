<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InviteMail extends Mailable
{
    use Queueable, SerializesModels;
    public $details;
    public $evento;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details, $evento)
    {
        $this->details = $details;
        $this->evento = $evento;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('view.name');
        return $this->view('email.mail', ['evento' => $this->evento])
            ->with('details', $this->details);
    }
}
