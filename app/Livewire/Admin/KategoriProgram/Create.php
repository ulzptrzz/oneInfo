<?php

namespace App\Livewire\Admin\KategoriProgram;

use App\Models\KategoriProgram;
use Livewire\Component;

class Create extends Component
{
    public $nama_kategori = '';
    public $deskripsi = '';
    protected $rules = [
        'nama_kategori' => 'required|string|max:255',
        'deskripsi' => 'required|string',
    ];
    public function save(){
        $this->validate();

        KategoriProgram::create([
            'nama_kategori' =>$this->nama_kategori,
            'deskripsi' => $this->deskripsi,
        ]);

        session()->flash('message','Kategori berhasil ditambahkan.');
        return redirect()->route('admin.kategori-program');
    }

    public function render()
    {
        return view('livewire.admin.kategori-program.create');
    }
}
