<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Perizinan;

class PerizinanMail extends Mailable
{
    use Queueable, SerializesModels;

    public $perizinan;

    public function __construct(Perizinan $perizinan)
    {
        $this->perizinan = $perizinan;
    }

    public function build()
    {
        $mail = $this->subject('Surat Perizinan Kegiatan')
            ->view('emails.perizinan-notify')
            ->with([
                'perizinan' => $this->perizinan,
                'pendaftaran' => $this->perizinan->pendaftaran,
            ]);

        // attach surat if exists
        if ($this->perizinan->surat_path && \Storage::disk('public')->exists($this->perizinan->surat_path)) {
            $mail->attach(storage_path('app/public/' . $this->perizinan->surat_path));
        }

        return $mail;
    }
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Perizinan Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.perizinan-notify',
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
