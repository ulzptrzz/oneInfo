<?php

namespace App\Livewire\Admin;

use App\Models\Pendaftaran;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Mail;
use App\Mail\PendaftaranDisetujuiMail;
use App\Mail\PendaftaranDitolakMail;

class ListPendaftaran extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = 'all';

    public function updateStatus($id, $action)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        if ($pendaftaran->status !== 'pending') {
            session()->flash('error', 'Pendaftaran sudah diproses sebelumnya.');
            return;
        }

        if ($action === 'approve') {
            $pendaftaran->update(['status' => 'approved']);
            Mail::to($siswaEmail)->send(new PendaftaranDisetujuiMail($pendaftaran));

            session()->flash('success', "Pendaftaran {$pendaftaran->siswa->user->name} untuk program {$pendaftaran->program->name} telah disetujui.");
        } elseif ($action === 'reject') {
            $pendaftaran->update(['status' => 'rejected']);
            Mail::to($siswaEmail)->send(new PendaftaranDitolakMail($pendaftaran));

            session()->flash('error', "Pendaftaran {$pendaftaran->siswa->user->name} untuk program {$pendaftaran->program->name} telah ditolak.");
        }
    }

    public function render()
    {
        $query = Pendaftaran::with(['siswa.user', 'program'])
            ->when(
                $this->search,
                fn($q) => $q
                    ->whereHas('siswa.user', fn($sq) => $sq->where('name', 'like', "%{$this->search}%"))
                    ->orWhereHas('program', fn($sq) => $sq->where('name', 'like', "%{$this->search}%"))
            )
            ->when($this->statusFilter !== 'all', fn($q) => $q->where('status', $this->statusFilter))
            ->latest()
            ->paginate(10);

        return view('livewire.admin.list-pendaftaran', [
            'pendaftarans' => $query
        ]);
    }
}
