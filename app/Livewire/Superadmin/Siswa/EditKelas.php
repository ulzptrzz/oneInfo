<?php

namespace App\Livewire\Superadmin\Siswa;

use App\Models\Kelas;
use Livewire\Component;

class EditKelas extends Component
{
    public $kelasId, $nama_kelas, $jurusan, $tingkat, $tahun_ajaran;

    public function mount($id)
    {
        $this->kelasId = $id;
        $this->loadKelas();
    }

    public function loadKelas()
    {
        $kelas = Kelas::findOrFail($this->kelasId);

        $this->nama_kelas = $kelas->nama_kelas;
        $this->jurusan = $kelas->jurusan;
        $this->tingkat = $kelas->tingkat;
        $this->tahun_ajaran = $kelas->tahun_ajaran;
    }

    public function update()
    {
        $this->validate([
            'nama_kelas' => 'required|string|max:50,' . $this->kelasId,
            'jurusan' => 'required|string|max:50',
            'tingkat' => 'required',
            'tahun_ajaran' => 'required|integer|min:1901|max:2155',
        ]);

        $kelas = Kelas::findOrFail($this->kelasId);
        $kelas->update([
            'nama_kelas' => $this->nama_kelas,
            'jurusan' => $this->jurusan,
            'tingkat' => $this->tingkat,
            'tahun_ajaran' => $this->tahun_ajaran,
        ]);

        return redirect()->route('superadmin.siswa.kelas-siswa');
    }
    public function render()
    {
        return view('livewire.superadmin.siswa.edit-kelas');
    }
}
