<?php

namespace App\Livewire\Admin\KategoriProgram;
use App\Models\KategoriProgram;
use Livewire\Component;

class Edit extends Component
{
    public $kategori_program_id, $nama_kategori, $deskripsi;

    protected $rules = [
        'nama_kategori' => 'required|string|max:255',
        'deskripsi' => 'required|string',
    ];
    
    public function mount($id) {
        $kategori = KategoriProgram::findOrFail($id);
        $this->kategori_program_id = $kategori->id;
        $this->nama_kategori = $kategori->nama_kategori;
        $this->deskripsi = $kategori->deskripsi;
    }

    public function update(){
        $this->validate();
        
        $kategori = KategoriProgram::findOrFail($this->kategori_program_id);
        $kategori->update([
            'nama_kategori' => $this->nama_kategori,
            'deskripsi' => $this->deskripsi,
        ]);

        session()->flash('message', 'Kategori berhasil diperbarui');
        return redirect()->route('admin.kategori-program');
    }
    public function render()
    {
        return view('livewire.admin.kategori-program.edit');
    }
}
