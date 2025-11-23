<?php

namespace App\Livewire\Admin\Dokumentasi;

use App\Models\Dokumentasi;
use App\Models\Prestasi;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $dokumentasiId;
    public $judul, $foto, $video, $oldFoto, $prestasi_id;

    protected $rules = [
        'prestasi_id' => 'required|exists:prestasi,id',
        'judul' => 'required|string|max:255',
        'foto' => 'nullable|image|max:3048', 
        'video' => 'nullable|url',
    ];

    protected $messages = [
        'prestasi_id.required' => 'Prestasi harus dipilih.',
        'prestasi_id.exists' => 'Prestasi tidak ditemukan.',
        'judul.required' => 'Judul wajib diisi.',
        'foto.image' => 'File foto harus berupa gambar.',
        'foto.max' => 'Ukuran foto maksimal 3MB.',
        'video.url' => 'Format URL video tidak benar.',
    ];

    public function mount($id)
    {
        $data = Dokumentasi::findOrFail($id);

        $this->dokumentasiId = $data->id;
        $this->prestasi_id = $data->prestasi_id;
        $this->judul = $data->judul;
        $this->video = $data->video;
        $this->oldFoto = $data->foto;
    }

    public function update()
    {
        $this->validate();

        $data = Dokumentasi::findOrFail($this->dokumentasiId);

        $path = $this->oldFoto;

        // jika upload baru
        if ($this->foto) {

            if ($this->oldFoto && file_exists(storage_path('app/public/' . $this->oldFoto))) {
                unlink(storage_path('app/public/' . $this->oldFoto));
            }

            $path = $this->foto->store('dokumentasi', 'public');
        }

        $data->update([
            'prestasi_id' => $this->prestasi_id,
            'judul' => $this->judul,
            'foto' => $path,
            'video' => $this->video,
        ]);

        session()->flash('message', 'Dokumentasi berhasil diperbarui.');

        return redirect()->route('admin.dokumentasi');
    }

    public function render()
    {
        return view('livewire.admin.dokumentasi.edit', [
            'prestasis' => Prestasi::with('siswa')->get()
        ]);
    }
}