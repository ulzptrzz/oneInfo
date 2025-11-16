<?php

namespace App\Livewire\Superadmin\Siswa;

use App\Models\Jurusan;
use App\Models\Kelas;
use Livewire\Component;

class CreateKelas extends Component
{
    public $nama_kelas = '';
    public $jurusan_id = '';
    public $tingkat = '';
    public $tahun_ajaran = '';

    public $jurusan_kelas;

    public function rules()
    {
        return [
            'nama_kelas' => 'required|string|max:50',
            'jurusan_id' => 'required|exists:jurusan,id',
            'tingkat' => 'required',
            'tahun_ajaran' => 'required|integer|min:1901|max:2155'
        ];
    }

    public function messages()
    {
        return [
            'nama_kelas.required' => 'Nama kelas wajib diisi',
            'nama_kelas.max' => 'Nama kelas tidak boleh melebihi 50 karakter',
            'jurusan_id.required' => 'jurusan wajib diisi',
            'tingkat.required' => 'Tingkat wajib diisi',
            'tahun_ajaran.required' => 'Tahun ajaran wajib diisi',
            'tahun_ajaran.integer' => 'Tahun ajaran harus angka',
            'tahun_ajaran.min' => 'Tahun ajaran minimal 1901',
            'tahun_ajaran.max' => 'Tahun ajaran maksimal 2155'
        ];
    }

    public function mount() {
        $this->jurusan_kelas = Jurusan::all();
    }

    public function store()
    {
        $this->validate();

        Kelas::create([
            'nama_kelas' => $this->nama_kelas,
            'jurusan_id' => $this->jurusan_id,
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
