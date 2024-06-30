<?php

namespace App\Mail;

use App\Models\Article;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Headers;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\Mime\Email;

class NoticeUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        protected User $user,
        protected ?Article $article = null,
    ) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Notice User',
            tags: ['notice'],
            metadata: [
                'article_id' => $this->article ? $this->article->id : 'xxx',
            ],
            using: [
                function (Email $message) {
                    //
                }
            ]
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            html: 'mail.notice-user',
            with: [
                'userName' => $this->user->name,
                'articleTitle' => $this->article ? $this->article->title : '',
                'articleContent' => $this->article ? $this->article->content : '',
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

    public function headers(): Headers
    {
        return new Headers(
            messageId: 'custom-notice-id@laravel.com',
            references: ['previous-notice@laravel.com'],
        );
    }
}
