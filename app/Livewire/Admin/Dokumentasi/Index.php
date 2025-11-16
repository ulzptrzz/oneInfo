<?php

namespace App\Livewire\Admin\Dokumentasi;

use App\Models\Dokumentasi;

use Livewire\Component;

class Index extends Component
{
    public $dokumentasi;

    public function mount()
    {
        $this->dokumentasi = Dokumentasi::all();
    }

    public function delete($id)
    {
        $data = Dokumentasi::find($id);
        if ($data) {
            if ($data->foto && file_exists(storage_path('app/public/' . $data->foto))) {
                unlink(storage_path('app/public/' . $data->foto));
            }
            $data->delete();
            session()->flash('message', 'Dokumentasi berhasil dihapus.');
            $this->dokumentasi = Dokumentasi::all();
        }
    }

    public function render()
    {
        return view('livewire.admin.dokumentasi.index', [
            'dokumentasi' => $this->dokumentasi,
        ]);
    }
}
