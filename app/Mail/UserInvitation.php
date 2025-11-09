<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Cliente;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $cliente;
    public $token;
    public $invitationUrl;

    public function __construct(User $user, Cliente $cliente, string $token)
    {
        $this->user = $user;
        $this->cliente = $cliente;
        $this->token = $token;
        $this->invitationUrl = route('invitation.accept', ['token' => $token]);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Invitación a ' . $this->cliente->name,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.user-invitation',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}