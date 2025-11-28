<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Mail\PendaftaranDitolakMail;
use App\Models\Pendaftaran;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendPendaftaranDitolakEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $pendaftaran;

    public function __construct(Pendaftaran $pendaftaran)
    {
        $this->pendaftaran = $pendaftaran;
    }

    public function handle(): void
    {
        $email = $this->pendaftaran->siswa->user->email;

        if ($this->pendaftaran->status === 'rejected') {
            Mail::to($email)->send(new PendaftaranDitolakMail($this->pendaftaran));
        }
    }
}
