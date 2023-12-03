<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $guestApplicationData;

    public function __construct(array $guestApplicationData)
    {
        $this->guestApplicationData = $guestApplicationData;
    }

    /**
     * Get the message envelope.
     */
    public function build() {
        return $this->view('emails.NewApplication_notification');
    }
}
