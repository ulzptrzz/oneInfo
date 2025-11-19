<?php

namespace App\Livewire\Guest;

use App\Mail\AdminNotifikasiPendaftaran;
use Carbon\Carbon;
use App\Models\Program;
use Livewire\Component;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;


class DetailProgram extends Component
{
   public $program;
    public $sudahDaftar = false;
    public $statusPendaftaran = null; 
    public $message = '';

    public function mount($id)
    {
        $this->program = Program::with('kategoriProgram')->findOrFail($id);

        if (Auth::check() && Auth::user()->siswa) {
            $pendaftaran = Pendaftaran::where('siswa_id', Auth::user()->siswa->id)
                                      ->where('program_id', $this->program->id)
                                      ->first();

            if ($pendaftaran) {
                $this->sudahDaftar = true;
                $this->statusPendaftaran = $pendaftaran->status;
            }
        }
    }

    public function daftar()
    {
        if (!Auth::check() || !Auth::user()->siswa) {
            $this->message = 'error|Kamu harus login sebagai siswa!';
            return;
        }

        $user = Auth::user();
        $siswaId = $user->siswa->id;

        $existing = Pendaftaran::where('siswa_id', $siswaId)
                               ->where('program_id', $this->program->id)
                               ->exists();

        if ($existing) {
            $this->message = 'error|Kamu sudah mendaftar program ini sebelumnya!';
            return;
        }

        Pendaftaran::create([
            'tanggal_daftar' => Carbon::today(),
            'status' => 'pending',
            'siswa_id' => $siswaId,
            'program_id' => $this->program->id,
        ]);

         $admin = User::where('role_id', 1)->get();

        foreach ($admin as $akun) {
            Mail::to($akun->email)->send(new AdminNotifikasiPendaftaran($user));
        }

        $this->sudahDaftar = true;
        $this->statusPendaftaran = 'pending';
        $this->message = 'success|Pendaftaran berhasil! Menunggu persetujuan admin.';
    }

    public function render()
    {
        return view('livewire.guest.detail-program');
    }
}
