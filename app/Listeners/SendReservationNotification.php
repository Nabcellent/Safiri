<?php

namespace App\Listeners;

use App\Events\Reserved;
use App\Models\User;
use App\Notifications\ReservationMade;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class SendReservationNotification implements ShouldQueue
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
            User::whereIn('is_admin', [true, 7])->get(), new ReservationMade($event->booking, true)
        );
    }
}
