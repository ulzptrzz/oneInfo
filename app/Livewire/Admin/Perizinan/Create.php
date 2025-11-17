<?php

namespace App\Livewire\Admin\Perizinan;

use App\Models\Perizinan;
use Livewire\Component;

class Create extends Component
{
    public $file = '';
    public $status = '';
    public $tanggal_konfirmasi = '';
    public $pendaftaran_id = '';

    protected $rules = [
        'file' => 'required|file',
        'status' => 'required|in:pending,approved,rejected',
        'tanggal_konfirmasi' => 'required:date',
        'pendaftaran_id' => 'required|exists:',
    ];
    public function render()
    {
        return view('livewire.admin.perizinan.create');
    }
}
