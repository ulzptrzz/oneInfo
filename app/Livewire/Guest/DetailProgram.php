<?php

namespace App\Livewire\Guest;

use App\Models\Pendaftaran;
use App\Models\Program;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminNotifikasiPendaftaran;

class DetailProgram extends Component
{
    use WithFileUploads;

    public $program, $syarat_program, $user, $foto, $tanggal_pendaftaran, $pelaksanaan, $mata_lomba_terpilih;
    public $mata_lomba = [];

    public $sudahTerdaftar = false;
    public $showFormModal = false;
    public $bolehDaftar = false;
    public $pendaftaran;

    public function mount($id)
    {
        $this->program = Program::with('kategoriProgram')->findOrFail($id);
        $this->user    = Auth::user();

        $this->mata_lomba = json_decode($this->program->mata_lomba, true) ?? [];

        $this->tanggal_pendaftaran = now()->format('Y-m-d');
        $this->pelaksanaan = $this->program->pelaksanaan ?? 'offline';

        if (Auth::check() && Auth::user()?->siswa) {
            $siswaId = Auth::user()->siswa->id;

            $this->sudahTerdaftar = Pendaftaran::where('siswa_id', $siswaId)
                ->where('program_id', $this->program->id)
                ->exists();

            $this->bolehDaftar = ! $this->sudahTerdaftar;

            $this->pendaftaran = Auth::check()
                ? Auth::user()->siswa->pendaftarans()
                ->where('program_id', $this->program->id)
                ->first()
                : null;
        } else {
            $this->sudahTerdaftar = false;
            $this->bolehDaftar    = false;
            $this->pendaftaran    = null;
        }
    }

    protected function rules()
    {
        return [
            'foto'                => 'required|image|mimes:jpg,jpeg,png,pdf|max:5048',
            'tanggal_pendaftaran' => 'required|date',
            'pelaksanaan'         => 'required|in:online,offline',
            'mata_lomba_terpilih' => 'required|in:' . implode(',', $this->mata_lomba),
            'syarat_program' => 'required|mimes:pdf|max:30000'
        ];
    }

    public function simpanPendaftaran()
    {
        $this->validate();

        $exists = Pendaftaran::where('siswa_id', $this->user->siswa->id)
            ->where('program_id', $this->program->id)
            ->exists();

        if ($exists) {
            session()->flash('error', 'Kamu sudah terdaftar di program ini!');
            return;
        }


        $path = $this->foto->store('bukti-pendaftaran', 'public');

        if ($this->syarat_program) {
            $pathSyarat = $this->syarat_program->store('panduan', 'public');
        }

        Pendaftaran::create([
            'tanggal_daftar'     => $this->tanggal_pendaftaran,
            'status'             => 'pending',
            'pelaksanaan'        => $this->pelaksanaan,
            'mata_lomba'         => $this->mata_lomba_terpilih,
            'bukti_pendaftaran'  => $path,
            'syarat_pendaftaran' => $pathSyarat,
            'siswa_id'           => $this->user->siswa->id,
            'program_id'         => $this->program->id,
        ]);

        Mail::to('mathildaanneke10@gmail.com')->send(new AdminNotifikasiPendaftaran($this->user));

        $this->reset(['foto', 'mata_lomba_terpilih']);
        session()->flash('success', 'Pendaftaran berhasil! Menunggu verifikasi admin.');
    }

    public function confirmPendaftaran()
    {
        $this->showFormModal = true;
        $this->sudahTerdaftar = true;
    }

    public function cancelPendaftaran()
    {
        $this->showFormModal = false;
    }

    public function render()
    {
        return view('livewire.guest.detail-program');
    }
}
