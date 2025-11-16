<?php

namespace App\Livewire\Admin\Prestasi;

use App\Models\Prestasi;
use App\Models\Siswa;
use App\Models\Program;
use App\Models\Dokumentasi;
use Livewire\Component;

class Edit extends Component
{
    public $prestasiId, $tanggal, $deskripsi, $siswa_id, $program_id, $dokumentasi_id;
    public $siswaList, $programList, $dokumentasiList;

    public function mount($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        $this->prestasiId = $prestasi->id;
        $this->tanggal = $prestasi->tanggal;
        $this->deskripsi = $prestasi->deskripsi;
        $this->siswa_id = $prestasi->siswa_id;
        $this->program_id = $prestasi->program_id;
        $this->dokumentasi_id = $prestasi->dokumentasi_id;

        $this->siswaList = Siswa::all();
        $this->programList = Program::all();
        $this->dokumentasiList = Dokumentasi::all();
    }

    public function update()
    {
        $this->validate([
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string|max:255',
            'siswa_id' => 'required|exists:siswa,id',
            'program_id' => 'required|exists:program,id',
            'dokumentasi_id' => 'required|exists:dokumentasi,id',
        ]);

        Prestasi::findOrFail($this->prestasiId)->update([
            'tanggal' => $this->tanggal,
            'deskripsi' => $this->deskripsi,
            'siswa_id' => $this->siswa_id,
            'program_id' => $this->program_id,
            'dokumentasi_id' => $this->dokumentasi_id,
        ]);

        session()->flash('message', 'Prestasi berhasil diperbarui.');
        return redirect()->route('admin.prestasi');
    }

    public function render()
    {
        return view('livewire.admin.prestasi.edit');
    }
}
