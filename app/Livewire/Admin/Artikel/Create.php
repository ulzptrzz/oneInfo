<?php

namespace App\Livewire\Admin\Artikel;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Artikel;

class Create extends Component
{
    use WithFileUploads;

    public $judul = '';
    public $deskripsi = '';
    public $status = 'draft';
    public $tanggal = '';
    public $thumbnail;

    protected $rules = [
        'judul' => 'required|string|max:50',
        'deskripsi' => 'required|string',
        'status' => 'required|in:draft,publised,archived',
        'tanggal' => 'required|date',
        'thumbnail' => 'required|image|max:2048',
    ];

    public function save()
    {
        $this->validate();

        $path = $this->thumbnail->store('thumbnail', 'public');

        Artikel::create([
            'judul' => $this->judul,
            'deskripsi' => $this->deskripsi,
            'status' => $this->status,
            'tanggal' => $this->tanggal,
            'thumbnail' => $path,
        ]);

        session()->flash('message', 'Artikel berhasil dibuat!');
        return redirect()->route('admin.artikel');
    }

    public function render()
    {
        return view('livewire.admin.artikel.create');
    }
}
