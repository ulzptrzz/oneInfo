<?php

namespace App\Livewire\Admin\Artikel;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Artikel;

class Edit extends Component
{
    use WithFileUploads;

    public $artikel;

    public $judul;
    public $deskripsi;
    public $status;
    public $tanggal;
    public $thumbnail;
    public $thumbnail_lama;

    protected $rules = [
        'judul' => 'required|string|max:50',
        'deskripsi' => 'required|string',
        'status' => 'required|in:draft,publised,archived',
        'tanggal' => 'required|date',
        'thumbnail' => 'nullable|image|max:2048',
    ];

    public function mount($id)
    {
        $this->artikel = Artikel::findOrFail($id);

        $this->judul       = $this->artikel->judul;
        $this->deskripsi   = $this->artikel->deskripsi;
        $this->status      = $this->artikel->status;
        $this->tanggal     = $this->artikel->tanggal;
        $this->thumbnail_lama = $this->artikel->thumbnail;
    }

    public function update()
    {
        $this->validate();

        $path = $this->thumbnail_lama;
        if ($this->thumbnail) {
            $path = $this->thumbnail->store('thumbnail', 'public');
        }

        $this->artikel->update([
            'judul' => $this->judul,
            'deskripsi' => $this->deskripsi,
            'status' => $this->status,
            'tanggal' => $this->tanggal,
            'thumbnail' => $path,
        ]);

        session()->flash('message', 'Artikel berhasil diperbarui!');
        return redirect()->route('admin.artikel');
    }

    public function render()
    {
        return view('livewire.admin.artikel.edit');
    }
}
