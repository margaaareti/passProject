<?php

namespace App\Mail\Notifications\Guests;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AddNewGuestNotification extends Mailable
{
    use Queueable, SerializesModels;

    public array $newGuestApplicationData;

    public function __construct(array $newGuestApplicationData)
    {
        $this->newGuestApplicationData = $newGuestApplicationData;
    }

    /**
     * Get the message envelope.
     */
    public function build() {
        return $this->view('emails.NewGuest_notification', $this->newGuestApplicationData);
    }
}
