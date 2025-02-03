<?php

namespace App\Mail\Portal;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreateStaffPortal extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details, $subject)
    {
        $this->details = $details;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject($this->subject)->markdown('layouts.Home.Staff.User.send_portal_template');

        return $this;
    }
}
