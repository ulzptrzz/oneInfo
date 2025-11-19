<?php

namespace App\Livewire\Guest;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Program as ModelProgram;

class Program extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = 'all';

    protected $queryString = ['search', 'statusFilter'];

    // Reset pagination saat search berubah
    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Reset pagination saat filter berubah
    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        $program = ModelProgram::query()
            ->with('kategoriProgram')
            ->when($this->search, function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })
            ->when($this->statusFilter !== 'all', function ($q) {
                $q->where('status', $this->statusFilter);
            })
            ->orderBy('tanggal_mulai', 'desc')
            ->paginate(9);

        return view('livewire.guest.program', [
            'program' => $program
        ]);
    }
}
