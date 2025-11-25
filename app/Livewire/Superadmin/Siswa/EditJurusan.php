<?php

namespace App\Livewire\Superadmin\Siswa;

use App\Models\Jurusan;
use Livewire\Component;

class EditJurusan extends Component
{
    public $jurusanId, $nama_jurusan, $deskripsi;

    public function mount($id)
    {
        $this->jurusanId = $id;
        $this->loadJurusan();
    }
    public function loadJurusan()
    {
        $jurusan = Jurusan::findOrFail($this->jurusanId);

        $this->nama_jurusan = $jurusan->nama_jurusan;
        $this->deskripsi = $jurusan->deskripsi;
    }

    public function rules()
    {
        return [
            'nama_jurusan' => 'required|string|min:3|max:100',
            'deskripsi' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'nama_jurusan.required' => 'Nama jurusan wajib di isi',
            'nama_jurusan.min' => 'Nama jurusan tidak boleh kurang dari 3',
            'nama_jurusan.max' => 'Nama jurusan tidak boleh melebihi 100',
            'deskripsi.required' => 'Deskripsi wajib di isi'
        ];
    }

    public function update()
    {
        $this->validate();

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
