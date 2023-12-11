<?php

namespace App\Mail\Notifications\Cars;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewCarApplicationNotification extends Mailable
{
    use Queueable, SerializesModels;

    public array $carApplicationData;

    public function __construct(array $carApplicationData)
    {
        $this->carApplicationData = $carApplicationData;
    }

    /**
     * Get the message envelope.
     */
    public function build() {
        return $this->view('emails.NewApplication_notification');
    }
}
