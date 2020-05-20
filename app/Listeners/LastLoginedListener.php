<?php

namespace App\Listeners;

use App\Events\Logined;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LastLoginedListener
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
     * @param  Logined  $event
     * @return void
     */
    public function handle(Logined $event)
    {
        //
    }
}
