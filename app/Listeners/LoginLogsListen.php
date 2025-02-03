<?php

namespace App\Listeners;

use App\Events\LoginLogs;

class LoginLogsListen
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(LoginLogs $event) {}
}
