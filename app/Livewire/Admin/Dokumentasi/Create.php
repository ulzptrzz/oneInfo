<?php

namespace App\Livewire\Admin\Dokumentasi;

use App\Models\Dokumentasi;
use App\Models\Prestasi;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $judul, $foto, $video, $prestasi_id;

    protected $rules = [
        'prestasi_id' => 'required|exists:prestasi,id',
        'judul' => 'required|string|max:255',
        'foto' => 'required|image|max:3048', // maks 3MB
        'video' => 'nullable|url',
    ];

    protected $messages = [
        'prestasi_id.required' => 'Prestasi harus dipilih.',
        'prestasi_id.exists' => 'Prestasi tidak ditemukan.',
        'judul.required' => 'Judul wajib diisi.',
        'foto.required' => 'Foto dokumentasi wajib diisi.',
        'foto.image' => 'File foto harus berupa gambar.',
        'foto.max' => 'Ukuran foto maksimal 3MB.',
        'video.url' => 'Format URL video tidak valid.',
    ];

    public function save()
    {
        $this->validate();

        $path = $this->foto->store('dokumentasi', 'public');

        Dokumentasi::create([
            'prestasi_id' => $this->prestasi_id,
            'judul' => $this->judul,
            'foto' => $path,
            'video' => $this->video,
        ]);

        return redirect()->route('admin.dokumentasi')
            ->with('message', 'Dokumentasi berhasil ditambahkan.');
    }

    public function render()
    {
        return view('livewire.admin.dokumentasi.create', [
            'prestasis' => Prestasi::with('siswa')->get()
        ]);
    }
}