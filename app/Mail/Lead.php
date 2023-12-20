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
        $belgianCompany = json_decode($this->lead->belgianCompany()->first()->payload, 1);
        return new Content(
            view: 'mailLead',
            with: [
                'firstname' => $this->lead->firstname,
                'lastname' => $this->lead->lastname,
                'email' => $this->lead->email,
                'telephone' => $this->lead->telephone,
                'company_name' => $belgianCompany['company_name'],
                'company_vat' => $belgianCompany['vat_formatted'],
                'company_telephone' => $belgianCompany['phone_number'],
                'company_email' => $belgianCompany['email']
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
