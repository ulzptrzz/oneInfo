<?php

namespace App\Livewire\Admin\Prestasi;

use App\Models\Siswa;
use App\Models\Program;
use App\Models\Prestasi;
use Livewire\Component;

class Create extends Component
{
    public $tanggal, $deskripsi, $siswa_id, $program_id;

    protected $rules = [
        'tanggal' => 'required|date',
        'deskripsi' => 'required|string',
        'siswa_id' => 'required|exists:siswa,id',
        'program_id' => 'required|exists:program,id',
    ];

    public function save()
    {
        $this->validate();

        Prestasi::create([
            'tanggal' => $this->tanggal,
            'deskripsi' => $this->deskripsi,
            'siswa_id' => $this->siswa_id,
            'program_id' => $this->program_id,
        ]);

        session()->flash('message', 'Prestasi berhasil ditambahkan.');
        return redirect()->route('admin.prestasi');
    }

    public function render()
    {
        return view('livewire.admin.prestasi.create', [
            'siswa' => Siswa::all(),
            'program' => Program::all(),
        ]);
    }
}
