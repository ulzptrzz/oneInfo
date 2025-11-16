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
        'foto' => 'nullable|image|max:3048', // maksimal 3MB
        'video' => 'nullable ', // maksimal 30MB
    ];

    public function save()
    {
        $this->validate();

        $path = $this->foto ? $this->foto->store('dokumentasi', 'public') : null;

        Dokumentasi::create([
            'judul' => $this->judul,
            'foto' => $path,
            'video' => $this->video,
        ]);

    return redirect()->route('admin.dokumentasi')->with('message', 'Dokumentasi berhasil ditambahkan.');

    }

    public function render()
    {
         return view('livewire.admin.dokumentasi.create');
    }
}
