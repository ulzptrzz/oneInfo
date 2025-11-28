<?php

namespace App\Livewire\Admin\Dokumentasi;

use App\Models\Dokumentasi;
use App\Models\Prestasi;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $judul = '';
    public $foto = [];           // Tetap ini
    public $newPhotos = [];           
    public $video = '';
    public $prestasi_id = '';

    protected $rules = [
        'prestasi_id' => 'required|exists:prestasi,id',
        'judul'       => 'required|string|max:255',
        'foto'        => 'required|array|min:1',
        'foto.*'      => 'image|mimes:jpeg,jpg,png,gif|max:3072', // 3MB
        'video'       => 'nullable|string',
    ];

    protected $messages = [
        'prestasi_id.required' => 'Pilih prestasi terlebih dahulu.',
        'judul.required'       => 'Judul dokumentasi wajib diisi.',
        'foto.required'        => 'Minimal upload 1 foto.',
        'foto.min'             => 'Minimal upload 1 foto.',
        'foto.*.mimes'         => 'Foto harus format JPG, PNG, atau GIF.',
        'foto.*.max'           => 'Ukuran foto maksimal 3MB.',
    ];

    // Hapus foto berdasarkan index
    public function updatedNewPhotos()
    {
        foreach ($this->newPhotos as $newPhoto) {
            $this->foto[] = $newPhoto;
        }
        $this->newPhotos = [];

        $this->dispatch('$refresh');
    }

    // removePhoto & save tetep sama
    public function removePhoto($index)
    {
        if (isset($this->foto[$index])) {
            unset($this->foto[$index]);
            $this->foto = array_values($this->foto); // reindex
        }
    }

    public function save()
    {
        $this->validate();

        $fotoPaths = [];
        foreach ($this->foto as $foto) {
            $fotoPaths[] = $foto->store('dokumentasi', 'public');
        }

        Dokumentasi::create([
            'prestasi_id' => $this->prestasi_id,
            'judul'       => $this->judul,
            'foto'        => json_encode($fotoPaths), // Simpan sebagai JSON array
            'video'       => $this->video ?? null,
        ]);

        return redirect()->route('admin.dokumentasi')
               ->with('message', 'Dokumentasi berhasil ditambahkan dengan ' . count($fotoPaths) . ' foto.');
    }

    
    public function render()
    {
        return view('livewire.admin.dokumentasi.create', [
            'prestasis' => Prestasi::with('siswa')->get(),
        ]);
    }
}