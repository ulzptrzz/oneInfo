<?php

namespace App\Livewire\Admin\Dokumentasi;

use App\Models\Dokumentasi;
use App\Models\Prestasi;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads; // Trait biar bisa upload file lewat Livewire

    // Variabel untuk nampung input dari form create
    public $judul, $foto, $video, $prestasi_id;

    // Rules validasi input
    protected $rules = [
        'prestasi_id' => 'required|exists:prestasi,id',
        'judul' => 'required|string|max:255',
        'foto' => 'required|image|max:3048', // foto wajib & max 3MB
        'video' => 'nullable|url', // video opsional, tapi harus berupa URL
    ];

    // Pesan error custom biar user paham kalau salah input
    protected $messages = [
        'prestasi_id.required' => 'Prestasi harus dipilih.',
        'prestasi_id.exists' => 'Prestasi tidak ditemukan.',
        'judul.required' => 'Judul wajib diisi.',
        'foto.required' => 'Foto dokumentasi wajib diisi.',
        'foto.image' => 'File foto harus berupa gambar.',
        'foto.max' => 'Ukuran foto maksimal 3MB.',
        'video.url' => 'Format URL video tidak valid.',
    ];

    // Fungsi untuk simpan data dokumentasi baru
    public function save()
    {
        $this->validate(); // Jalankan validasi

        // Simpan file foto ke storage/public/dokumentasi
        $path = $this->foto->store('dokumentasi', 'public');

        // Insert data ke database
        Dokumentasi::create([
            'prestasi_id' => $this->prestasi_id,
            'judul' => $this->judul,
            'foto' => $path,
            'video' => $this->video,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.dokumentasi')
            ->with('message', 'Dokumentasi berhasil ditambahkan.');
    }

    // Render halaman create + kirim data prestasi untuk dropdown
    public function render()
    {
        return view('livewire.admin.dokumentasi.create', [
            'prestasis' => Prestasi::with('siswa')->get() // Ambil daftar prestasi + relasi siswa
        ]);
    }
}
