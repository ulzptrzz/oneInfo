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
    public $deskripsi = '';
    public $tanggal_mulai = '';
    public $tanggal_selesai = '';
    public $status = '';
    public $poster = '';
    public $penyelenggara = [];
    public $penyelenggaraInput = "";
    public $tingkat = '';
    public $mata_lomba = [];
    public $mataLombaInput = "";
    public $pelaksanaan = "";
    public $link_pendaftaran = '';
    public $panduan_file;
    public $panduan_link = '';
    public $kategori_program_id = '';
    public $user_id = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'tanggal_mulai' => 'required|date',
        'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        'status' => 'required|in:draft,published,archived',
        'poster' => 'required|image|max:2048',
        'penyelenggara' => 'required|array|min:1',
        'tingkat' => 'nullable|string|max:255',
        'mata_lomba' => 'nullable|array|min:1',
        'pelaksanaan' => 'required|in:online,offline',
        'link_pendaftaran' => 'nullable|url',
        'panduan_file' => 'nullable|mimes:pdf|max:20000',
        'panduan_link' => 'nullable|url',
        'kategori_program_id' => 'required|exists:kategori_program,id',
    ];

    public function save()
    {
        $this->validate();

        $path = $this->poster ? $this->poster->store('posters', 'public') : null;

        if ($this->panduan_file) {
            $pathPanduan = $this->panduan_file->store('panduan', 'public');
        } elseif (!empty($this->panduan_link)) {
            $pathPanduan = $this->panduan_link;
        } else {
            $pathPanduan = null;
        }

        $program = Program::create([
            'name' => $this->name,
            'deskripsi' => $this->deskripsi,
            'tanggal_mulai' => $this->tanggal_mulai,
            'tanggal_selesai' => $this->tanggal_selesai,
            'status' => $this->status,
            'poster' => $path,
            'penyelenggara' => json_encode($this->penyelenggara),
            'tingkat' => $this->tingkat,
            'mata_lomba' => json_encode($this->mata_lomba),
            'pelaksanaan' => $this->pelaksanaan,
            'link_pendaftaran' => $this->link_pendaftaran,
            'panduan_lomba' => $pathPanduan,
            'kategori_program_id' => $this->kategori_program_id,
            'user_id' => auth()->id(),
        ]);

        $siswa = User::where('role_id', 3)->get();

        foreach ($siswa as $akun) {
            Mail::to($akun->email)->send(new ProgramEmail($program));
        }

        session()->flash('message', 'Program berhasil ditambahkan.');
        return redirect()->route('admin.program');
    }

    public function addPenyelenggara()
    {
        if ($this->penyelenggaraInput !== "") {
            $this->penyelenggara[] = $this->penyelenggaraInput;
            $this->penyelenggaraInput = "";
        }
    }

    public function removePenyelenggara($index)
    {
        unset($this->penyelenggara[$index]);
        $this->penyelenggara = array_values($this->penyelenggara);
    }

    public function addMataLomba()
    {
        if ($this->mataLombaInput !== "") {
            $this->mata_lomba[] = $this->mataLombaInput;
            $this->mataLombaInput = "";
        }
    }

    public function removeMataLomba($index)
    {
        unset($this->mata_lomba[$index]);
        $this->mata_lomba = array_values($this->mata_lomba);
    }

    protected $messages = [
        'poster.image' => 'Poster harus berupa gambar dengan format JPG, PNG, JPEG, atau WEBP.',
        'poster.max' => 'Ukuran poster maksimal 2MB.',

        'panduan_file.mimes' => 'Panduan file harus berformat PDF.',
        'panduan_file.max' => 'Ukuran file panduan maksimal 20MB.',
    ];

    public function render()
    {
        $kategori_program = KategoriProgram::all();
        return view('livewire.admin.program.create', compact('kategori_program'));
    }
}
