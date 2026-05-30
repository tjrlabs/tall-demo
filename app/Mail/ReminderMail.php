<?php

namespace App\Mail;

use App\Models\Reminder;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public readonly Reminder $reminder) {}

    public function envelope(): Envelope
    {
        $post = $this->reminder->post;
        $mins = $this->reminder->remind_before_minutes;
        $label = $mins === 60 ? '1 hour' : "{$mins} minutes";

        return new Envelope(
            subject: "Reminder: \"{$post->title}\" starts in {$label}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.reminder',
        );
    }
}
