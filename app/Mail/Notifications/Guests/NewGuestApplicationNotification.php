<?php

namespace App\Mail\Notifications\Guests;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewGuestApplicationNotification extends Mailable
{
    use Queueable, SerializesModels;

    public array $guestApplicationData;

    public function __construct(array $guestApplicationData)
    {
        $this->guestApplicationData = $guestApplicationData;
    }

    /**
     * Get the message envelope.
     */
    public function build() {
        return $this->view('emails.NewGuestApplication_notification');
    }
}
