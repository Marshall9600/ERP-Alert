<?php

namespace App\Jobs\Admin;

use App\Mail\Portal\CreateStaffPortal;
use App\Models\API\Oauth\Oauth;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendingPortal implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email;

    public $details;

    public $sub;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $details, $sub)
    {
        $this->email = $email;
        $this->details = $details;
        $this->sub = $sub;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $OauthSMTP = Oauth::where('apioauth_ticket_smtp_id', '1')->first();
        config(['mail.mailers.autoresponder.password' => ($OauthSMTP->apioauth_ticket_smtp_access_token ?? '')]);

        Mail::mailer('autoresponder')->to($this->email)->send(new CreateStaffPortal($this->details, $this->sub));
    }
}
