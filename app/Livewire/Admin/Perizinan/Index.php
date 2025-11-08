<?php

namespace App\Livewire\Admin\Perizinan;

use Livewire\Component;
use App\Models\Perizinan;
use Livewire\WithPagination;

class Index extends Component
{
    public $perizinan_id, $nama_siswa, $kelas, $alasan, $tanggal, $status;
    public function render()
    {
        return view('livewire.admin.perizinan.index');
    }
}
