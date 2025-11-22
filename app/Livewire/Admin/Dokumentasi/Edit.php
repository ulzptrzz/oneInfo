<?php

namespace App\Livewire\Admin\Dokumentasi;

use App\Models\Dokumentasi;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $dokumentasiId;
    public $judul, $foto, $video, $oldFoto;

    protected $rules = [
        'judul' => 'required|string|max:255',
        'foto' => 'nullable|image|max:2048',
        'video' => 'nullable|url',
    ];

    public function mount($id)
    {
        $data = Dokumentasi::findOrFail($id);

        $this->dokumentasiId = $data->id;
        $this->judul = $data->judul;
        $this->video = $data->video;
        $this->oldFoto = $data->foto;
    }

    public function update()
    {
        $this->validate();

        $data = Dokumentasi::findOrFail($this->dokumentasiId);

        $path = $this->oldFoto;

        if ($this->foto) {
            // hapus foto lama
            if ($this->oldFoto && file_exists(storage_path('app/public/' . $this->oldFoto))) {
                unlink(storage_path('app/public/' . $this->oldFoto));
            }

            // upload baru
            $path = $this->foto->store('dokumentasi', 'public');
        }

        $data->update([
            'judul' => $this->judul,
            'foto' => $path,
            'video' => $this->video,
        ]);

        session()->flash('message', 'Dokumentasi berhasil diperbarui.');
        return redirect()->route('admin.dokumentasi');
    }

    protected $messages = [
        'judul.required' => 'Judul wajib diisi.',
        'foto.image' => 'File foto harus berupa gambar.',
        'foto.max' => 'Ukuran foto maksimal 3MB.',
        'video.url' => 'Format URL video tidak benar.',
    ];

    public function render()
    {
        
        return view('livewire.admin.dokumentasi.edit');
    }
}
