<?php

namespace App\Livewire\Admin\Dokumentasi;

use Livewire\Component;
use App\Models\Prestasi;
use App\Models\Dokumentasi;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads; // Trait biar bisa upload file lewat Livewire

    // Variabel yang dipakai di halaman edit
    public $dokumentasiId;
    public $judul, $video, $prestasi_id;
    public $foto = [];
    public $newPhotos = [];

    // Rules validasi
    protected $rules = [
        'prestasi_id' => 'required|exists:prestasi,id',
        'judul'       => 'required|string|max:255',
        'foto'        => 'required|array|min:1',
        'foto.*'      => 'image|mimes:jpeg,jpg,png,gif|max:3072', // 3MB
        'video'       => 'nullable|url',
    ];

    // Pesan error custom
    protected $messages = [
        'prestasi_id.required' => 'Pilih prestasi terlebih dahulu.',
        'judul.required'       => 'Judul dokumentasi wajib diisi.',
        'foto.required'        => 'Minimal upload 1 foto.',
        'foto.min'             => 'Minimal upload 1 foto.',
        'foto.*.mimes'         => 'Foto harus format JPG, PNG, atau GIF.',
        'foto.*.max'           => 'Ukuran foto maksimal 3MB.',
    ];

    public function updatedNewPhotos()
    {
        foreach ($this->newPhotos as $photo) {
            $this->foto[] = $photo;
        }
        $this->newPhotos = [];
    }

    public function removePhoto($index)
    {
        if (isset($this->foto[$index])) {
            // Kalau foto lama → hapus dari storage
            if (is_string($this->foto[$index])) {
                Storage::disk('public')->delete($this->foto[$index]);
            }
            unset($this->foto[$index]);
            $this->foto = array_values($this->foto);
        }
    }

    // Fungsi yang dijalankan pas halaman pertama kali dibuka
    public function mount($id)
    {
        $data = Dokumentasi::findOrFail($id); // Ambil data dokumentasi

        // Isi form dengan data lama
        $this->dokumentasiId = $data->id;
        $this->prestasi_id = $data->prestasi_id;
        $this->judul = $data->judul;
        $this->video = $data->video;
        $this->foto = json_decode($data->foto, true) ?? [];
    }

    // Fungsi update data dokumentasi
    public function update()
    {
        $this->validate(); // Validasi input

        $data = Dokumentasi::findOrFail($this->dokumentasiId);

        $fotoPaths = [];
        foreach ($this->foto as $foto) {
            if (is_string($foto)) {
                $fotoPaths[] = $foto; // foto lama
            } else {
                $fotoPaths[] = $foto->store('dokumentasi', 'public'); // foto baru
            }
        }

        // Update data di database
        $data->update([
            'prestasi_id' => $this->prestasi_id,
            'judul' => $this->judul,
            'foto' => $fotoPaths,
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
