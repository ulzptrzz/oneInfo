<?php

namespace App\Livewire\Admin\Program;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Program;
use App\Models\KategoriProgram;

class Index extends Component
{

    public $program_id, $nama_program, $deskripsi, $tanggal_mulai, $tanggal_selesai, $status, $poster, $penyelenggara, $tingkat, $mataLomba, $user_id, $kategori_program_id;

    public function render()
    {
        return view('livewire.admin.program.index', [
            'programs' => Program::where('nama_program', 'like', "%{$this->search}%")
                ->with('kategori')
                ->latest()
                ->paginate(10),
            'kategoris' => KategoriProgram::all(),
        ]);
    }

    public function openModal()
    {
        $this->resetForm();
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function save()
    {
        $this->validate();

        $path = $this->gambar ? $this->gambar->store('programs', 'public') : null;

        Program::updateOrCreate(
            ['id' => $this->program_id],
            [
                'nama_program' => $this->nama_program,
                'deskripsi' => $this->deskripsi,
                'gambar' => $path,
                'kategori_program_id' => $this->kategori_program_id,
            ]
        );

        session()->flash('message', $this->program_id ? 'Program updated successfully.' : 'Program created successfully.');

        $this->closeModal();
        $this->resetForm();
    }

    public function edit($id)
    {
        $program = Program::findOrFail($id);
        $this->program_id = $program->id;
        $this->nama_program = $program->nama_program;
        $this->deskripsi = $program->deskripsi;
        $this->kategori_program_id = $program->kategori_program_id;
        $this->isModalOpen = true;
    }

    public function delete($id)
    {
        Program::findOrFail($id)->delete();
        session()->flash('message', 'Program deleted successfully.');
    }

    private function resetForm()
    {
        $this->reset(['program_id', 'nama_program', 'deskripsi', 'gambar', 'kategori_program_id']);
    }
}
