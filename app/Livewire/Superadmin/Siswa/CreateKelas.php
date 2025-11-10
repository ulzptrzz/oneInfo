<?php

namespace App\Livewire\Superadmin\Siswa;

use App\Models\Kelas;
use Livewire\Component;

class CreateKelas extends Component
{
    public $nama_kelas = '';
    public $jurusan = '';
    public $tingkat = '';
    public $tahun_ajaran = '';

    public function rules()
    {
        return [
            'nama_kelas' => 'required|string|max:50',
            'jurusan' => 'required|string|max:50',
            'tingkat' => 'required',
            'tahun_ajaran' => 'required|integer|min:1901|max:2155'
        ];
    }

    public function messages()
    {
        return [
            'nama_kelas.required' => 'Nama kelas wajib diisi',
            'nama_kelas.max' => 'Nama kelas tidak boleh melebihi 50 karakter',
            'jurusan.required' => 'jurusan wajib diisi',
            'jurusan.max' => 'Nama jurusan tidak boleh melebihi 50 karakter',
            'tingkat.required' => 'Tingkat wajib diisi',
            'tahun_ajaran.required' => 'Tahun ajaran wajib diisi',
            'tahun_ajaran.integer' => 'Tahun ajaran harus angka',
            'tahun_ajaran.min' => 'Tahun ajaran minimal 1901',
            'tahun_ajaran.max' => 'Tahun ajaran maksimal 2155'
        ];
    }

    public function store()
    {
        $this->validate();

        Kelas::create([
            'nama_kelas' => $this->nama_kelas,
            'jurusan' => $this->jurusan,
            'tingkat' => $this->tingkat,
            'tahun_ajaran' => $this->tahun_ajaran
        ]);

        $this->reset();
        return redirect()->route('superadmin.siswa.kelas-siswa');
    }


    public function render()
    {
        return view('livewire.superadmin.siswa.create-kelas');
    }
}
