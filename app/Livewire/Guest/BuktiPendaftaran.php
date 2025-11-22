<?php

namespace App\Livewire\Guest;

use App\Models\Pendaftaran;
use App\Models\Program;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminNotifikasiPendaftaran;

class BuktiPendaftaran extends Component
{
    use WithFileUploads;

    public $bukti, $user, $foto, $tanggal_pendaftaran, $pelaksanaan, $mata_lomba_terpilih;
    public function mount($id)
    {
        $this->bukti = Program::findOrFail($id);
        $this->user  = Auth::user();

        $this->tanggal_pendaftaran = now()->format('Y-m-d');
        $this->pelaksanaan = $this->bukti->pelaksanaan ?? 'offline';
    }

    protected function rules()
    {
        return [
            'foto'                => 'required|image|mimes:jpg,jpeg,png,pdf|max:3048',
            'tanggal_pendaftaran' => 'required|date',
            'pelaksanaan'         => 'required|in:online,offline',
        ];
    }

    protected $messages = [
        'foto.required'    => 'Bukti pendaftaran wajib diupload.',
        'pelaksanaan.required' => 'Pilih pelaksanaan lomba.',
    ];

    public function simpan()
    {
        $this->validate();

        // Cek apakah sudah pernah daftar
        $exists = Pendaftaran::where('siswa_id', $this->user->siswa->id)
            ->where('program_id', $this->bukti->id)
            ->exists();

        if ($exists) {
            $this->addError('foto', 'Kamu sudah terdaftar di program ini.');
            return;
        }

        // Simpan file
        $path = $this->foto->store('bukti-pendaftaran', 'public');

        Pendaftaran::create([
            'tanggal_daftar'     => $this->tanggal_pendaftaran,
            'status'             => 'pending',
            'pelaksanaan'        => $this->pelaksanaan,
            'bukti_pendaftaran'  => $path,
            'syarat_pendaftaran' => null,
            'siswa_id'           => $this->user->siswa->id,
            'program_id'         => $this->bukti->id,
        ]);

        Mail::to('mathildaanneke10@gmail.com')->send(new AdminNotifikasiPendaftaran($this->user));

        // Reset form
        $this->reset();
        $this->tanggal_pendaftaran = now()->format('Y-m-d');

        session()->flash('success', 'Pendaftaran berhasil dikirim! Silakan tunggu konfirmasi.');
    }

    public function render()
    {
        return view('livewire.guest.bukti-pendaftaran');
    }
}
