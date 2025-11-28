<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Mail\AdminNotifikasiPendaftaran;
use App\Models\Pendaftaran;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendPendaftaranMasukEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email;
    public $pendaftaran;
    public function __construct($email, Pendaftaran $pendaftaran)
    {
        $this->email = $email;
        $this->pendaftaran = $pendaftaran;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)->send(new AdminNotifikasiPendaftaran($this->pendaftaran));
    }
}
