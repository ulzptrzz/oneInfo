<?php

namespace App\Livewire\Admin\Prestasi;

use App\Models\Siswa;
use App\Models\Program;
use App\Models\Prestasi;
use Livewire\Component;

class Create extends Component
{
    // Variabel buat nampung inputan dari form
    public $tanggal, $deskripsi, $siswa_id, $program_id;

    // Aturan validasi input
    protected $rules = [
        'tanggal' => 'required|date',
        'deskripsi' => 'required|string',
        'siswa_id' => 'required|exists:siswa,id',
        'program_id' => 'required|exists:program,id',
    ];

    // Fungsi buat nyimpen data prestasi baru
    public function save()
    {
        $this->validate(); // Cek apakah input sudah sesuai rules

        // Insert data baru ke database
        Prestasi::create([
            'tanggal' => $this->tanggal,
            'deskripsi' => $this->deskripsi,
            'siswa_id' => $this->siswa_id,
            'program_id' => $this->program_id,
        ]);

        session()->flash('message', 'Prestasi berhasil ditambahkan.'); // Pesan sukses
        return redirect()->route('admin.prestasi'); // Balik ke halaman daftar prestasi
    }

    // Render halaman create dan kirim data siswa + program
    public function render()
    {
        return view('livewire.admin.prestasi.create', [
            'siswa' => Siswa::all(), // Buat nampilin opsi pilihan siswa
            'program' => Program::all(), // Buat pilihan program
        ]);
    }
}
