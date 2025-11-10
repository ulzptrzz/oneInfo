<?php

namespace App\Livewire\Admin\Program;

use App\Models\Program;
use Livewire\WithFileUploads;
use Livewire\Component;

class Edit extends Component
{
    use WithFileUploads;

    public $program_id, $nama_program, $deskripsi, $tanggal_mulai, $tanggal_selesai, $status, $poster, $penyelenggara, $tingkat, $mata_lomba;
    public $oldPoster;
    protected $rules = [
        'nama_program' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'tanggal_mulai' => 'required|date',
        'tanggal_selesai' => 'required|date',
        'status' => 'required',
        'poster' => '',
        'penyelenggara' => '',
        'tingkat' => '',
        'mata_lomba' => '',
    ];

    public function mount($id)
    {
        $program = Program::findOrFail($id);
        $this->program_id = $program->program_id;
        $this->nama_program = $program->nama_program;
        $this->deskripsi = $program->deskripsi;
        $this->tanggal_mulai = $program->tanggal_mulai;
        $this->tanggal_selesai = $program->tanggal_selesai;
        $this->status = $program->status;
        $this->oldPoster = $program->poster;
        $this->penyelenggara = $program->penyelenggara;
        $this->tingkat = $program->tingkat;
        $this->mata_lomba = $program->mata_lomba;
    }

    public function update()
    {
        $program = Program::findOrFail($this->program_id);

        if ($this->poster instanceof \Livewire\TemporaryUploadedFile) {
            $path = $this->poster->store('posters', 'public');
        } else {
            $path = $this->oldPoster; 
        }

        $program->update([
            'nama_program' => $this->nama_program,
            'deskripsi' => $this->deskripsi,
            'tanggal_mulai' => $this->tanggal_mulai,
            'tanggal_selesai' => $this->tanggal_selesai,
            'status' => $this->status,
            'poster' => $path,
            'penyelenggara' => $this->penyelenggara,
            'tingkat' => $this->tingkat,
            'mata_lomba' => $this->mata_lomba,

        ]);

        session()->flash('message', 'Program berhasil diperbarui.');
        return redirect()->route('admin.program');
    }

    public function render()
    {
        return view('livewire.admin.program.edit');
    }
}
