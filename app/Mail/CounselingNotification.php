<?php

namespace App\Mail;

use App\Models\Inbox;
use App\Models\Mentor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CounselingNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(private $inbox, private $mentor)
    {

    }

    public function envelope(): Envelope
    {
        return new Envelope(
            to: $this->mentor->email,
            subject: $this->inbox->subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.mentor_notification',
            with: ['inbox' => $this->inbox],
        );
    }
}
