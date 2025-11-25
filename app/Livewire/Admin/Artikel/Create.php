<?php

namespace App\Livewire\Admin\Artikel;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Artikel;

class Create extends Component
{
    use WithFileUploads; // Trait untuk upload file

    // Property untuk menampung input form
    public $judul = '';
    public $deskripsi = '';
    public $status = '';
    public $tanggal = '';
    public $thumbnail;

    // Validasi input
    protected $rules = [
        'judul' => 'required|string|max:50',
        'deskripsi' => 'required|string',
        'status' => 'required|in:draft,publised,archived',
        'tanggal' => 'required|date',
        'thumbnail' => 'required|image|max:2048',
    ];

    // Fungsi untuk menyimpan data artikel baru
    public function save()
    {
        $this->validate(); // Validasi data input

        // Simpan file thumbnail ke storage/public/thumbnail
        $path = $this->thumbnail->store('thumbnail', 'public');

        // Simpan artikel ke database
        Artikel::create([
            'judul' => $this->judul,
            'deskripsi' => $this->deskripsi,
            'status' => $this->status,
            'tanggal' => $this->tanggal,
            'thumbnail' => $path,
        ]);

        // Notifikasi sukses
        session()->flash('message', 'Artikel berhasil ditambahkan.');

        // Redirect ke halaman index artikel
        return redirect()->route('admin.artikel');
    }

    // Render tampilan create.blade.php
    public function render()
    {
        return view('livewire.admin.artikel.create');
    }
}