<?php

namespace App\Livewire\Admin\Prestasi;

use App\Models\Prestasi;
use Livewire\Component;

class Index extends Component
{
    public function delete($id)
    {
        Prestasi::findOrFail($id)->delete();
        session()->flash('message', 'Prestasi berhasil dihapus.');
    }

    public function render()
    {
        $prestasi = Prestasi::with(['siswa', 'program', 'dokumentasi'])->get();
       return view('livewire.admin.prestasi.index', compact('prestasi'));
    }
}
