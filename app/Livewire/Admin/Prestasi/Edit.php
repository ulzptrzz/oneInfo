<?php

namespace App\Livewire\Admin\Prestasi;

use App\Models\Prestasi;
use App\Models\Siswa;
use App\Models\Program;
use App\Models\Dokumentasi;
use Livewire\Component;

class Edit extends Component
{
    // Variabel yang akan diisi di form edit
    public $prestasiId, $tanggal, $deskripsi, $siswa_id, $program_id, $dokumentasi_id;

    // Data list buat dropdown
    public $siswaList, $programList, $dokumentasiList;

    // Fungsi yang dijalanin pas halaman pertama kali kebuka
    public function mount($id)
    {
        $prestasi = Prestasi::findOrFail($id); // Cari data prestasi berdasarkan id

        // Isi form otomatis pakai data lama
        $this->prestasiId = $prestasi->id;
        $this->tanggal = $prestasi->tanggal;
        $this->deskripsi = $prestasi->deskripsi;
        $this->siswa_id = $prestasi->siswa_id;
        $this->program_id = $prestasi->program_id;
        $this->dokumentasi_id = $prestasi->dokumentasi_id;

        // Ambil data buat dropdown pilihan
        $this->siswaList = Siswa::all();
        $this->programList = Program::all();
        $this->dokumentasiList = Dokumentasi::all();
    }

    // Fungsi buat update data
    public function update()
    {
        // Validasi input terlebih dahulu
        $this->validate([
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string|max:255',
            'siswa_id' => 'required|exists:siswa,id',
            'program_id' => 'required|exists:program,id',
       ]);

        // Update data ke database
        Prestasi::findOrFail($this->prestasiId)->update([
            'tanggal' => $this->tanggal,
            'deskripsi' => $this->deskripsi,
            'siswa_id' => $this->siswa_id,
            'program_id' => $this->program_id,
        ]);

        session()->flash('message', 'Prestasi berhasil diperbarui.'); // Pesan sukses
        return redirect()->route('admin.prestasi'); // Balik ke halaman utama
    }

    // Tampilkan halaman edit
    public function render()
    {
        return view('livewire.admin.prestasi.edit');
    }
}