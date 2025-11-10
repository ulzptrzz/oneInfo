<?php

namespace App\Livewire\Admin\Perizinan;

use Livewire\Component;
use App\Models\Perizinan;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class Index extends Component
{
    public $perizinan;

    public function mount(){
        $user = Auth::user();

        $this->perizinan = Perizinan::all();
    }

    public function delete($id){
        $perizinan = Perizinan::find($id)?->delete();

        if($perizinan){
            $perizinan->delete();
            session()->flash('message', 'Kategori berhasil dihapus.');

            $this->perizinan = Perizinan::orderBy('id', 'desc')->get();
        }
    }

    public function render()
    {
        return view('livewire.admin.perizinan.index', ['perizinan' => $this->perizinan,]);
    }
}
