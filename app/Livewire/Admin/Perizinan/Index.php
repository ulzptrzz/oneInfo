<?php

namespace App\Livewire\Admin\Perizinan;

use Livewire\Component;
use App\Models\Perizinan;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $perizinans = Perizinan::with(['pendaftaran.siswa.user', 'pendaftaran.program', 'admin'])
            ->when($this->search, function ($q) {
                $q->whereHas('pendaftaran.siswa.user', function ($sq) {
                    $sq->where('name', 'like', "%{$this->search}%");
                });
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.perizinan.index', [
            'perizinans' => $perizinans  
        ]);
    }
}
