<?php

namespace App\Livewire\Admin\Dokumentasi;

use App\Models\Dokumentasi;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $judul, $foto, $video;

    protected $rules = [
        'judul' => 'required|string|max:255',
        'foto' => 'required|image|max:3048', // maksimal 3MB
        'video' => 'nullable ', // maksimal 30MB
    ];

    public function save()
    {
        $this->validate(); // Foto wajib di sini

        $path = $this->foto->store('dokumentasi', 'public');

        Dokumentasi::create([
            'judul' => $this->judul,
            'foto' => $path,
            'video' => $this->video,
        ]);

        return redirect()->route('admin.dokumentasi')
            ->with('message', 'Dokumentasi berhasil ditambahkan.');
    }
    protected $messages = [
        'judul.required' => 'Judul wajib diisi.',
        'foto.required' => 'Foto dokumentasi wajib diisi.',
        'foto.image' => 'File foto harus berupa gambar.',
        'foto.max' => 'Ukuran foto maksimal 3MB.',
        'video.url' => 'Format URL video tidak valid.',
    ];


    public function render()
    {
         return view('livewire.admin.dokumentasi.create');
    }
}
