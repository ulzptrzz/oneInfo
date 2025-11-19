<?php

namespace App\Livewire\Admin\Perizinan;

use App\Models\Perizinan;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Request;
use App\Models\Pendaftaran;
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

    public function kirimDispen(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:4096'
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);

        $file = $request->file->store('surat_dispen', 'public');

        $perizinan = Perizinan::create([
            'pendaftaran_id' => $pendaftaran->id,
            'file_dispen' => $file
        ]);

        Mail::to($pendaftaran->user->email)->send(new NotifDispen($perizinan));

        return back()->with('message', 'Surat dispen berhasil dikirim');
    }
    public function render()
    {
        return view('livewire.admin.perizinan.create');
    }
}
