<?php

namespace App\Livewire\Admin\Perizinan;

use App\Models\Perizinan;
use Livewire\Component;
use App\Models\Pendaftaran;
use Livewire\WithFileUploads;
use App\Mail\PerizinanMail;
use Illuminate\Support\Facades\Mail;


class Create extends Component
{
    use WithFileUploads;

    public $pendaftaranId;
    public $pendaftaran;
    public $catatan;
    public $surat_file; // TemporaryUploadedFile
    public $showForm = true;

    protected $rules = [
        'catatan' => 'nullable|string|max:2000',
        'surat_file' => 'required|mimes:pdf|max:20000', 
    ];

    public function mount($pendaftaranId)
    {
        $this->pendaftaranId = $pendaftaranId;
        $this->pendaftaran = Pendaftaran::with('siswa.user', 'program')->findOrFail($pendaftaranId);

        // guard: only if approved and offline
        if ($this->pendaftaran->status !== 'approved' || $this->pendaftaran->program->pelaksanaan !== 'offline') {
            abort(403, 'Tidak bisa mengirim perizinan untuk pendaftaran ini.');
        }

        // if perizinan already exists, load its data
        $existing = Perizinan::where('pendaftaran_id', $pendaftaranId)->first();
        if ($existing) {
            $this->catatan = $existing->catatan;
            $this->showForm = $existing->status === 'pending'; // if already sent hide form
        }
    }

    public function send()
    {
        $this->validate();

        $perizinan = Perizinan::firstOrNew(['pendaftaran_id' => $this->pendaftaranId]);

        if ($this->surat_file) {
            $path = $this->surat_file->store('perizinan', 'public');
            $perizinan->file = $path;
        }

        $perizinan->catatan = $this->catatan;
        $perizinan->user_id = auth()->id();
        $perizinan->status = 'dikirim';
        $perizinan->tanggal_dikirim = now();
        $perizinan->save();
        
        $this->pendaftaran->update([
            'status' => 'finished'
        ]);

        // send email to siswa (ke email user terkait siswa)
        $siswaUser = $this->pendaftaran->siswa->user;

        Mail::to($siswaUser->email)->send(new PerizinanMail($perizinan));

        session()->flash('success', 'Perizinan berhasil dikirim dan email sudah dikirim ke siswa.');
        return redirect()->route('list-pendaftaran-program');
    }

    protected $messages = [
        'surat_file.mimes' => 'File surat perizinan harus berformat PDF.',
        'surat_file.max' => 'Ukuran file surat perizinan maksimal 20MB.',
    ];

    public function render()
    {
        return view('livewire.admin.perizinan.create');
    }
}
