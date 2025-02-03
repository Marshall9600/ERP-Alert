<?php

namespace App\Mail\Portal;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordPortal extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    public $sub;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details, $sub)
    {
        $this->details = $details;
        $this->subject = $sub;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject($this->sub)->markdown('layouts.Auth.Send.forgot_password');

        return $this;
    }
}
