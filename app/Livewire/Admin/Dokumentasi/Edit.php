<?php

namespace App\Livewire\Admin\Dokumentasi;

use App\Models\Dokumentasi;
use App\Models\Prestasi;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads; // Trait biar bisa upload file lewat Livewire

    // Variabel yang dipakai di halaman edit
    public $dokumentasiId;
    public $judul, $foto, $video, $oldFoto, $prestasi_id;

    // Rules validasi
    protected $rules = [
        'prestasi_id' => 'required|exists:prestasi,id',
        'judul' => 'required|string|max:255',
        'foto' => 'nullable|image|max:3048', // Maksimal 3MB
        'video' => 'nullable|url',
    ];

    // Pesan error custom
    protected $messages = [
        'prestasi_id.required' => 'Prestasi harus dipilih.',
        'prestasi_id.exists' => 'Prestasi tidak ditemukan.',
        'judul.required' => 'Judul wajib diisi.',
        'foto.image' => 'File foto harus berupa gambar.',
        'foto.max' => 'Ukuran foto maksimal 3MB.',
        'video.url' => 'Format URL video tidak benar.',
    ];

    // Fungsi yang dijalankan pas halaman pertama kali dibuka
    public function mount($id)
    {
        $data = Dokumentasi::findOrFail($id); // Ambil data dokumentasi

        // Isi form dengan data lama
        $this->dokumentasiId = $data->id;
        $this->prestasi_id = $data->prestasi_id;
        $this->judul = $data->judul;
        $this->video = $data->video;
        $this->oldFoto = $data->foto; // Simpan foto lama biar bisa dipakai ulang
    }

    // Fungsi update data dokumentasi
    public function update()
    {
        $this->validate(); // Validasi input

        $data = Dokumentasi::findOrFail($this->dokumentasiId);

        // Default foto tetap foto lama
        $path = $this->oldFoto;

        // Jika user upload foto baru
        if ($this->foto) {

            // Hapus file foto lama dari storage
            if ($this->oldFoto && file_exists(storage_path('app/public/' . $this->oldFoto))) {
                unlink(storage_path('app/public/' . $this->oldFoto));
            }

            // Simpan foto baru
            $path = $this->foto->store('dokumentasi', 'public');
        }

        // Update data di database
        $data->update([
            'prestasi_id' => $this->prestasi_id,
            'judul' => $this->judul,
            'foto' => $path,
            'video' => $this->video,
        ]);

        session()->flash('message', 'Dokumentasi berhasil diperbarui.');

        return redirect()->route('admin.dokumentasi');
    }

    // Render halaman edit
    public function render()
    {
        return view('livewire.admin.dokumentasi.edit', [
            'prestasis' => Prestasi::with('siswa')->get() // Data untuk dropdown
        ]);
    }
}