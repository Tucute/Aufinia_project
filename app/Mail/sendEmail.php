<?php

namespace App\Mail;

// use App\Models\Licensekey;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class sendEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $licenseKey = '';
    public $email = '';
    public $invoice_date='';

    /**
     * Create a new message instance.
     */
    // public function __construct()
    // {
    //     //
    // }

    public function __construct($licenseKey, $email, $invoice_date)
    {
        $this->licenseKey = $licenseKey;
        $this->email = $email;
        $this->invoice_date = $invoice_date;
    } 

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Thank you for pay Supplier Checker',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail_information',
            with: [
                'licensekey'=>$this->licenseKey,
                'email'=>$this->email,
                'invoice_date'=>$this->invoice_date,
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
