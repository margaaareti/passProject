<?php

namespace App\Modules\Admin\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApproveApplicationEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected array $sendingData;

    public function __construct(array $sendingData)
    {
        $this->sendingData = $sendingData;
    }


    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Approve Application Email',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.approve_application',
            with: $this->sendingData,
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
