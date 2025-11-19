<?php

namespace App\Livewire\Superadmin;

use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\User;
use App\Models\Siswa;
use Livewire\Component;

class Dashboard extends Component
{
    public $jumlahSiswa, $jumlahAdmin, $jumlahKelas, $jumlahJurusan;

    public function mount() {
        $this->jumlahSiswa = Siswa::count();
        $this->jumlahAdmin = User::where('role_id', '2')->count();
        $this->jumlahKelas = Kelas::count();
        $this->jumlahJurusan = Jurusan::count();
    }
    public function render()
    {
        return view('livewire.superadmin.dashboard');
    }
}
