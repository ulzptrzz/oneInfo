<?php

namespace App\Livewire\Siswa;

use App\Models\Siswa;
use App\Models\Prestasi;
use App\Models\Pendaftaran;
use App\Models\Program;
use App\Models\Bookmark;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public $siswa;
    public $prestasi;
    public $pendaftaran;
    public $favorit;
    public $rekomendasi = [];
    public $deadline = [];

    public function mount()
    {
        $this->siswa = Siswa::where('user_id', Auth::id())->first();
        
        // Hitung statistik
        $this->prestasi = Prestasi::where('siswa_id', $this->siswa->id)->count();
        $this->pendaftaran = Pendaftaran::where('siswa_id', $this->siswa->id)->count();
        $this->favorit = Bookmark::where('user_id', Auth::id())->count();
        
        // Rekomendasi Program (exclude yang sudah didaftar)
        $registeredProgramIds = Pendaftaran::where('siswa_id', $this->siswa->id)
            ->pluck('program_id')
            ->toArray();
            
        $rekomendasiPrograms = Program::with('kategoriProgram')
            ->where('status', 'active')
            ->whereNotIn('id', $registeredProgramIds)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        // Format rekomendasi
        $this->rekomendasi = $rekomendasiPrograms->map(function($program) {
            return [
                'id' => $program->id,
                'nama' => $program->name,
                'kategori' => $program->kategoriProgram->name ?? 'Umum',
                'tingkat' => $program->tingkat ?? '-',
                'penyelenggara' => $program->penyelenggara ?? '-',
            ];
        })->toArray();
        
        // Deadline Terdekat (Program yang belum berakhir)
        $deadlinePrograms = Program::where('status', 'active')
            ->where('tanggal_selesai', '>=', now())
            ->orderBy('tanggal_selesai', 'asc')
            ->take(5)
            ->get();
        
        // Format deadline
        $this->deadline = $deadlinePrograms->map(function($program) {
            $tanggalSelesai = \Carbon\Carbon::parse($program->tanggal_selesai);
            $daysLeft = now()->diffInDays($tanggalSelesai, false);
            
            return [
                'id' => $program->id,
                'nama' => $program->name,
                'tanggal' => $tanggalSelesai->format('d M Y'),
                'days_left' => $daysLeft,
                'status' => $this->getDeadlineStatus($daysLeft)
            ];
        })->toArray();
    }

    private function getDeadlineStatus($daysLeft)
    {
        if ($daysLeft < 0) {
            return 'expired';
        } elseif ($daysLeft <= 3) {
            return 'urgent';
        } elseif ($daysLeft <= 7) {
            return 'warning';
        } else {
            return 'normal';
        }
    }

    public function render()
    {
        return view('livewire.siswa.dashboard');
    }
}