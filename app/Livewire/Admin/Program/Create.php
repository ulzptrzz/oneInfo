<?php

namespace App\Livewire\Admin\Program;

use App\Mail\ProgramEmail;
use App\Models\KategoriProgram;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\Program;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class Create extends Component
{
    use WithFileUploads;
    public $name = '';
    public $deskripsi_singkat = '';
    public $tanggal_mulai = '';
    public $tanggal_selesai = '';
    public $status = '';
    public $poster = '';
    public $penyelenggara = '';
    public $tingkat = '';
    public $mata_lomba = '';
    public $kategori_program_id = '';
    public $user_id = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'deskripsi_singkat' => 'required|string',
        'tanggal_mulai' => 'required|date',
        'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        'status' => 'required|in:draft,published,archived',
        'poster' => 'nullable|image|max:2048',
        'penyelenggara' => 'nullable|string|max:255',
        'tingkat' => 'nullable|string|max:255',
        'mata_lomba' => 'nullable|string|max:255',
        'kategori_program_id' => 'required|exists:kategori_program,id',
    ];

    public function save()
    {
        $this->validate();

        $path = $this->poster ? $this->poster->store('posters', 'public') : null;

        // SIMPAN PROGRAM DAN KEMBALIKAN OBJEK PROGRAM
        $program = Program::create([
            'name' => $this->name,
            'deskripsi_singkat' => $this->deskripsi_singkat,
            'tanggal_mulai' => $this->tanggal_mulai,
            'tanggal_selesai' => $this->tanggal_selesai,
            'status' => $this->status,
            'poster' => $path,
            'penyelenggara' => $this->penyelenggara,
            'tingkat' => $this->tingkat,
            'mata_lomba' => $this->mata_lomba,
            'kategori_program_id' => $this->kategori_program_id,
            'user_id' => auth()->id(),
        ]);

        // KIRIM EMAIL KE SEMUA SISWA
        $siswa = User::where('role_id', 3)->get();

        foreach ($siswa as $akun) {
            Mail::to($akun->email)->send(new ProgramEmail($program));
        }

        session()->flash('message', 'Program berhasil ditambahkan.');
        return redirect()->route('admin.program');
    }


    public function render()
    {
        $kategori_program = KategoriProgram::all();
        return view('livewire.admin.program.create', compact('kategori_program'));
    }
}
