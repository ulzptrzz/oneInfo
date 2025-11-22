<?php

namespace App\Livewire\Admin\Pendaftaran;

use Livewire\Component;
use App\Models\Pendaftaran;

class Detail extends Component
{
    public $id;
    public $pendaftaran;

    public function mount($id)
    {
        $this->pendaftaran = Pendaftaran::with(['siswa.user', 'program'])
            ->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.admin.pendaftaran.detail', ['pendaftaran' => $this->pendaftaran]);
    }
}
