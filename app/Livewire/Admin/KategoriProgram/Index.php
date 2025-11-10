<?php

namespace App\Livewire\Admin\KategoriProgram;

use App\Models\KategoriProgram;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $kategoriProgram;

    public function mount(){
        $user = Auth::user();

        $this->kategoriProgram = KategoriProgram::all();
    }

    public function delete($id){
        $kategori = KategoriProgram::find($id);

        if($kategori){
            $kategori->delete();
            session()->flash('message', 'Kategori berhasil dihapus.');

            $this->kategoriProgram = KategoriProgram::orderBy('id', 'desc')->get();
        }
    }

    public function render()
    {
        return view('livewire.admin.kategori-program.index', ['kategori' => $this->kategoriProgram,]);
    }
}
