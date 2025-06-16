<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResponseToUser extends Mailable
{
    use Queueable, SerializesModels;

    protected $complaint;
    protected $departmentUser;
    /**
     * Create a new message instance.
     */
    public function __construct($complaint, $departmentUser)
    {
        $this->complaint = $complaint;
        $this->departmentUser = $departmentUser;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->departmentUser->email, $this->departmentUser->name),
            subject: 'Response To Your Complaint',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.responsetouser',
            with: [
                'complaint' => $this->complaint,
                'departmentUser' => $this->departmentUser,
            ]
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
