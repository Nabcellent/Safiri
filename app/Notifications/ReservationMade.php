<?php

namespace App\Notifications;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationMade extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(public Booking $booking, public bool $sendToAdmins = false) {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via(mixed $notifiable): array {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail(mixed $notifiable): MailMessage {
        $salutation = $notifiable->gender === 'male'
            ? 'Sir.'
            : "Ma'am";

        if($this->sendToAdmins) {
            $greeting = Carbon::timelyGreeting() . "!";
            $intro = "A booking has been made by {$this->booking->user->full_name}.";
            $actionUrl = route('admin.bookings.show', ['id' => $this->booking->id]);
            $closing = "Please attend to it at your earliest convenience😌!";
        } else {
            $greeting = "Hey {$notifiable->first_name},";
            $intro = "Thank you very much for your reservation to {$this->booking->destination->name} which has been received successfully.";
            $actionUrl = route('user.account');
            $closing = "Thank you for being part of the Safiri family! Can't wait for the trip😁";
        }

        return (new MailMessage)->salutation($salutation)->greeting($greeting)->line($intro)
            ->action('View Booking', $actionUrl)->line($closing);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray(mixed $notifiable): array {
        return [//
        ];
    }
}
