<?php

namespace App\Livewire\Siswa;

use App\Models\Prestasi;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class PrestasiSiswa extends Component
{
    public function render()
    {
        $siswa = Auth::user()->siswa;
        
        // Ambil prestasi hanya milik siswa yang login
        $prestasis = Prestasi::with(['program'])
            ->where('siswa_id', $siswa->id)
            ->latest()
            ->get();
        
        return view('livewire.siswa.prestasi-siswa', [
            'prestasis' => $prestasis,
            'siswa' => $siswa
        ]);
    }
}