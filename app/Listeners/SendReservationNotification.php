<?php

namespace App\Listeners;

use App\Events\Reserved;
use App\Models\User;
use App\Notifications\ReservationMade;
use Illuminate\Support\Facades\Notification;

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
        Notification::send($event->booking->user, new ReservationMade($event->booking));
        Notification::send(
            User::whereIsAdmin(true)->get(), new ReservationMade($event->booking, true)
        );
    }
}
