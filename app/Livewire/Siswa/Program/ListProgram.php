<?php

namespace App\Livewire\Siswa\Program;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;

class ListProgram extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = 'all'; 

    public function render()
    {
        if (!Auth::check() || !Auth::user()->siswa) {
            return view('livewire.errors.unauthorized');
        }

        $siswaId = Auth::user()->siswa->id;

        $query = Pendaftaran::with(['program.kategoriProgram'])
            ->where('siswa_id', $siswaId)
            ->when($this->search, function ($q) {
                $q->whereHas('program', function ($sq) {
                    $sq->where('name', 'like', "%{$this->search}%")
                       ->orWhere('penyelenggara', 'like', "%{$this->search}%");
                });
            })
            ->when($this->statusFilter !== 'all', function ($q) {
                $q->where('status', $this->statusFilter);
            })
            ->latest('tanggal_daftar')
            ->paginate(10);

        return view('livewire.siswa.program.list-program', [
            'pendaftarans' => $query
        ]);
    }
}