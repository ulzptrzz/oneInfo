<?php

namespace App\Livewire\Admin\Artikel;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Artikel;

class Edit extends Component
{
    use WithFileUploads;

    public $artikel; // Menampung data artikel lama

    // Field yang akan diedit
    public $judul;
    public $deskripsi;
    public $status;
    public $tanggal;
    public $thumbnail; // File baru (jika diupload)
    public $thumbnail_lama; // Thumbnail lama

    // Validasi input
    protected $rules = [
        'judul' => 'required|string|max:50',
        'deskripsi' => 'required|string',
        'status' => 'required|in:draft,publised,archived',
        'tanggal' => 'required|date',
        'thumbnail' => 'nullable|image|max:2048',
    ];

    // Mengisi form dengan data artikel sesuai ID
    public function mount($id)
    {
        $this->artikel = Artikel::findOrFail($id);

        $this->judul       = $this->artikel->judul;
        $this->deskripsi   = $this->artikel->deskripsi;
        $this->status      = $this->artikel->status;
        $this->tanggal     = $this->artikel->tanggal;
        $this->thumbnail_lama = $this->artikel->thumbnail; // Simpan thumbnail lama
    }

    // Fungsi update data artikel
    public function update()
    {
        $this->validate(); // Validasi input

        // Jika upload thumbnail baru → simpan file baru
        $path = $this->thumbnail_lama;
        if ($this->thumbnail) {
            $path = $this->thumbnail->store('thumbnail', 'public');
        }

        // Update data artikel
        $this->artikel->update([
            'judul' => $this->judul,
            'deskripsi' => $this->deskripsi,
            'status' => $this->status,
            'tanggal' => $this->tanggal,
            'thumbnail' => $path,
        ]);

        // Notifikasi sukses
        session()->flash('message', 'Artikel berhasil diperbarui.');

        // Redirect ke halaman index artikel
        return redirect()->route('admin.artikel');
    }

    // Render tampilan edit.blade.php
    public function render()
    {
        return view('livewire.admin.artikel.edit');
    }
}