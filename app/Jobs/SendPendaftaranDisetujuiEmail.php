<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Mail\PendaftaranDisetujuiMail;
use App\Models\Pendaftaran;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendPendaftaranDisetujuiEmail implements ShouldQueue
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

        // CEK — hanya kirim sekali!
        if ($this->pendaftaran->status === 'approved') {
            Mail::to($email)->send(new PendaftaranDisetujuiMail($this->pendaftaran));
        }
    }
}
