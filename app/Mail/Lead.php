<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Lead extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(private readonly \App\Models\Lead $lead)
    {
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Lead',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $belgianCompany = $this->lead->belgianCompany()->first();
        return new Content(
            view: 'email.mailLead',
            with: [
                'firstname' => $this->lead->firstname,
                'lastname' => $this->lead->lastname,
                'email' => $this->lead->email,
                'telephone' => $this->lead->telephone,
                'sector' => $this->lead->sector,
                'sector_construction' => $this->lead->sector_construction,
                'company_name' => $belgianCompany->business_name,
                'company_vat' => $belgianCompany->identifier,
                'company_telephone' => $belgianCompany->company_telephone,
                'company_email' => $belgianCompany->company_email,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
