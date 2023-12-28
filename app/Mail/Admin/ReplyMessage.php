<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReplyMessage extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    protected $data;
    protected $name;

    public function __construct($data, $name)
    {
        $this->data = $data;
        $this->name = $name;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $fromAddress = config("setting.smtp_from_address", env("MAIL_FROM_ADDRESS")) ?? "";
        $fromName = config("setting.smtp_from_name", env("MAIL_FROM_NAME")) ?? "";
        $replyAddress = config("setting.smtp_reply_address", env("MAIL_REPLY_ADDRESS")) ?? "";

        $from = new Address($fromAddress, $fromName);
        $replyTo = [new Address($replyAddress)];
        $to = [new Address($this->data->email)];
        $subject = $this->data->subject;

        return new Envelope(from: $from, replyTo: $replyTo, to: $to, subject: $subject);
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'admin.emails.reply_message',
            with: [
                'text' => $this->data->message,
                'name' => $this->name,
                'title' => config("setting.title", env("APP_NAME"))
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
