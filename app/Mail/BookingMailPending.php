<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingMailPending extends Mailable
{
    use Queueable, SerializesModels;

    protected array $validated;   //panggil data $validated, ingat ini wajib array

    /**
     * Create a new message instance.
     */
    public function __construct(array $validated) //ini diambil dari data yang dikirim dari controller, ingat ini wajib array
    {
        $this->validated = $validated;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('yummyrestaurant@gmail.com', 'Yummy Restaurant'),
            subject: 'Booking Mail Pending',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.booking.pending',
            with: [
                'booking' => $this->validated   //pakai data $validated
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
