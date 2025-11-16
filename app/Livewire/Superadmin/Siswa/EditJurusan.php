<?php

namespace App\Livewire\Superadmin\Siswa;

use App\Models\Jurusan;
use Livewire\Component;

class EditJurusan extends Component
{
    public $jurusanId, $nama_jurusan, $deskripsi;

    public function mount($id) {
        $this->jurusanId = $id;
        $this->loadJurusan();
    }
    public function loadJurusan(){
        $jurusan = Jurusan::findOrFail($this->jurusanId);

        $this->nama_jurusan = $jurusan->nama_jurusan;
        $this->deskripsi = $jurusan->deskripsi;
    }

    public function update() {
        $this->validate([
            'nama_jurusan' => 'required|string|max:100',
            'deskripsi' => 'required|string'
        ]);

        $jurusan = Jurusan::findOrFail($this->jurusanId);
        $jurusan->update([
            'nama_jurusan' => $this->nama_jurusan,
            'deskripsi' => $this->deskripsi
        ]);

        return redirect()->route('superadmin.siswa.kelola-jurusan');
    }
    public function render()
    {
        return view('livewire.superadmin.siswa.edit-jurusan');
    }
}
