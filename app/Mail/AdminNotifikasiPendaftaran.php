<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class AdminNotifikasiPendaftaran extends Mailable
{
    use Queueable, SerializesModels;

    public $pendaftaran;

    public function __construct($pendaftaran)
    {
        $this->pendaftaran = $pendaftaran;
    }


    public function build()
    {
        return $this->subject('Pendaftaran Siswa Baru')
            ->markdown('emails.admin.pendaftaran');
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Admin Notifikasi Pendaftaran',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.admin.pendaftaran',
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
