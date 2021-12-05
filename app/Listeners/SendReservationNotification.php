<?php

namespace App\Listeners;

use App\Events\Reserved;

class SendReservationNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    /**
     * Handle the event.
     *
     * @param Reserved $event
     * @return void
     */
    public function handle(Reserved $event) {
        //
    }
}
