<?php

namespace App\Livewire\Admin;

use App\Models\Pendaftaran;
use Livewire\Component;

class DetailPendaftaran extends Component
{
    public $pendaftaran;

    public function mount($id){
        $this->pendaftaran = Pendaftaran::findOrFail($id);
    }
    public function render()
    {
        return view('livewire.admin.detail-pendaftaran');
    }
}
