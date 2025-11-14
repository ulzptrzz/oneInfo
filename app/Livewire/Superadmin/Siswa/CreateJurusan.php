<?php

namespace App\Livewire\Superadmin\Siswa;

use App\Models\Jurusan;
use Livewire\Component;

class CreateJurusan extends Component
{
    public $nama_jurusan = '';
    public $deskripsi = '';

    public function rules(){
        return [
            'nama_jurusan' => 'required|string|min:3|max:100',
            'deskripsi' => 'required|string'
        ];
    }

    public function messages(){
        return [
            'nama_jurusan.required' => 'Nama jurusan wajib di isi',
            'nama_jurusan.min' => 'Nama jurusan tidak boleh kurang dari 3',
            'nama_jurusan.max' => 'Nama jurusan tidak boleh melebihi 100',
            'deskripsi.required' => 'Deskripsi wajib di isi'
        ];
    }

    public function store() {
        $this->validate();

        Jurusan::create([
            'nama_jurusan' => $this->nama_jurusan,
            'deskripsi' => $this->deskripsi
        ]);

        $this->reset();
        return redirect()->route('superadmin.siswa.kelola-jurusan');
    }
    public function render()
    {
        return view('livewire.superadmin.siswa.create-jurusan');
    }
}
