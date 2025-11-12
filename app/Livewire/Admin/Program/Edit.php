<?php

namespace App\Livewire\Admin\Program;

use App\Models\Program;
use App\Models\KategoriProgram;
use Livewire\WithFileUploads;
use Livewire\Component;

class Edit extends Component
{
    use WithFileUploads;

    public $program_id, $name, $deskripsi_singkat, $tanggal_mulai, $tanggal_selesai, $status, $poster, $penyelenggara, $tingkat, $mata_lomba, $kategori_program_id;
    public $oldPoster;
    protected $rules = [
        'name' => 'required|string|max:255',
        'deskripsi_singkat' => 'required|string',
        'tanggal_mulai' => 'required|date',
        'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        'status' => 'required|in:draft,published,archived',
        'poster' => 'nullable|image|max:2048',
        'penyelenggara' => 'nullable|string|max:255',
        'tingkat' => 'nullable|string|max:255',
        'mata_lomba' => 'nullable|string|max:255',
        'kategori_program_id' => 'required|exists:kategori_program,id',        
    ];

    public function mount($id)
    {
        $program = Program::findOrFail($id);
        $this->program_id = $program->program_id;
        $this->name = $program->name;
        $this->deskripsi_singkat = $program->deskripsi_singkat;
        $this->tanggal_mulai = $program->tanggal_mulai;
        $this->tanggal_selesai = $program->tanggal_selesai;
        $this->status = $program->status;
        $this->oldPoster = $program->poster;
        $this->penyelenggara = $program->penyelenggara;
        $this->tingkat = $program->tingkat;
        $this->mata_lomba = $program->mata_lomba;
        $this->kategori_program_id = $program->kategori_program_id;
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
            'name' => $this->name,
            'deskripsi_singkat' => $this->deskripsi_singkat,
            'tanggal_mulai' => $this->tanggal_mulai,
            'tanggal_selesai' => $this->tanggal_selesai,
            'status' => $this->status,
            'poster' => $path,
            'penyelenggara' => $this->penyelenggara,
            'tingkat' => $this->tingkat,
            'mata_lomba' => $this->mata_lomba,
            'kategori_program_id' => $this->kategori_program_id,

        ]);

        session()->flash('message', 'Program berhasil diperbarui.');
        return redirect()->route('admin.program');
    }

    public function render()
    {
        $kategori_program = KategoriProgram::all();
        return view('livewire.admin.program.edit', compact('kategori_program'));
    }
}
