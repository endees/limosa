<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;

class LimosaGenerated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        private readonly string $attachmentPath
    ) {
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Limosa Generated',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.mailResult',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        /** @var Filesystem $filesystem */
        $filesystem = App::make(Filesystem::class);
        $limosas = $filesystem->files($this->attachmentPath);
        $attachments = [];
        /** @var \SplFileInfo $limosa */
        foreach ($limosas as $limosa) {
            $attachments[] = Attachment::fromPath($limosa);
        }
        return $attachments;
    }
}
