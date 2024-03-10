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


    public function build() {
        return $this->view('emails.NewCarApplication_notification');
    }
}
