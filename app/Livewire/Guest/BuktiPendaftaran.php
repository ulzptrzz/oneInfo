<?php

namespace App\Livewire\Guest;

use App\Models\Pendaftaran;
use App\Models\Program;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;


class BuktiPendaftaran extends Component
{
    use WithFileUploads;

    public $bukti, $user, $bukti_pendaftaran;

    public function mount($id)
    {
        $this->user = Auth::user();
        $this->bukti = Program::findOrFail($id);
        $this->bukti_pendaftaran = Pendaftaran::all();
    }

    public function rules(){
        return [
            'tanggal_daftar' => 'required|date',
            'bukti_pendaftaran' => 'required|image|max:2048',
            'status' => 'required',
            'syarat_pendaftaran' => 'nullable',
            'mata_lomba' => 'required'
        ];
    }

    

    public function render()
    {
        return view('livewire.guest.bukti-pendaftaran');
    }
}
