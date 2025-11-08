<?php

namespace App\Livewire\Admin\KategoriProgram;

use App\Models\KategoriProgram;
use Livewire\Component;

class Index extends Component
{
    public $kategori_id, $nama_kategori, $deskripsi;
    public $isEditing = false;

    public function save() {
        $this->validate();
        KategoriProgram::updateOrCreate(['id' => $this->kategori_id], ['nama' => $this->nama_kategori], ['deskripsi' => $this->deskripsi]);
        $this->resetForm();
    }

    public function edit($id) {
        $kategori = KategoriProgram::find($id);
        $this->kategori_id = $kategori->id;
        $this->nama_kategori = $kategori->nama;
        $this->deskripsi = $kategori->deskripsi;
        $this->isEditing = true;
    }

    public function delete($id){
        KategoriProgram::find($id)?->delete();
    }

    public function resetForm() {
        $this->reset(['kategori_id', 'nama_kategori', 'deskripsi', 'isEditing']);
    }

    public function render()
    {
        return view('livewire.admin.kategori-program.index', ['kategoris' => KategoriProgram::orderBy('id', 'desc')->get(),])->dashboard('admin.dashboard');
    }
}
