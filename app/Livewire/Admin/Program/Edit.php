<?php

namespace App\Livewire\Admin\Program;

use App\Models\Program;
use App\Models\KategoriProgram;
use Livewire\WithFileUploads;
use Livewire\Component;

class Edit extends Component
{
    use WithFileUploads;

    public $program_id, $name, $deskripsi, $tanggal_mulai, $tanggal_selesai, $status;
    public $poster, $oldPoster;
    public $penyelenggara = [];
    public $penyelenggaraInput = '';
    public $mataLombaInput = '';

    public $tingkat, $mata_lomba = [], $pelaksanaan;
    public $link_pendaftaran;
    public $panduan_lomba, $panduan_file, $panduan_link;
    public $kategori_program_id;

    protected $rules = [
        'name' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'tanggal_mulai' => 'required|date',
        'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        'status' => 'required|in:draft,published,archived',
        'poster' => 'nullable|image|max:2048',
        'penyelenggara' => 'required|array|min:1',
        'tingkat' => 'nullable|string|max:255',
        'mata_lomba' => 'nullable|array',
        'pelaksanaan' => 'required|in:online,offline',
        'link_pendaftaran' => 'nullable|url',
        'panduan_file' => 'nullable|mimes:pdf|max:20000',
        'panduan_link' => 'nullable|url',
        'kategori_program_id' => 'required|exists:kategori_program,id',
    ];

    public function mount($id)
    {
        $program = Program::findOrFail($id);

        $this->program_id = $program->id;
        $this->name = $program->name;
        $this->deskripsi = $program->deskripsi;
        $this->tanggal_mulai = $program->tanggal_mulai;
        $this->tanggal_selesai = $program->tanggal_selesai;
        $this->status = $program->status;

        $this->oldPoster = $program->poster;
        $this->penyelenggara = $program->penyelenggara ?? [];
        $this->tingkat = $program->tingkat;
        $this->mata_lomba = $program->mata_lomba ?? [];
        $this->pelaksanaan = $program->pelaksanaan;

        $this->link_pendaftaran = $program->link_pendaftaran;
        $this->panduan_lomba = $program->panduan_lomba;

        $this->kategori_program_id = $program->kategori_program_id;
    }

    public function update()
    {
        $this->validate();

        $program = Program::findOrFail($this->program_id);

        $this->tingkat = $this->tingkat ?: null;

        // POSTER
        if ($this->poster instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
            $posterPath = $this->poster->store('posters', 'public');
        } else {
            $posterPath = $this->oldPoster;
        }

        $penyelenggara = is_array($this->penyelenggara)
            ? $this->penyelenggara
            : [$this->penyelenggara];

        $mata_lomba = is_array($this->mata_lomba)
            ? $this->mata_lomba
            : [$this->mata_lomba];

        // PANDUAN LOMBA
        if ($this->panduan_file instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
            $pathPanduan = $this->panduan_file->store('panduan', 'public');
        } elseif (!empty($this->panduan_link)) {
            $pathPanduan = $this->panduan_link;
        } else {
            $pathPanduan = $this->panduan_lomba;
        }

        $program->update([
            'name' => $this->name,
            'deskripsi' => $this->deskripsi,
            'tanggal_mulai' => $this->tanggal_mulai,
            'tanggal_selesai' => $this->tanggal_selesai,
            'status' => $this->status,
            'poster' => $posterPath,
            'penyelenggara' => $penyelenggara,
            'tingkat' => $this->tingkat,
            'mata_lomba' => $mata_lomba,
            'pelaksanaan' => $this->pelaksanaan,
            'link_pendaftaran' => $this->link_pendaftaran,
            'panduan_lomba' => $pathPanduan,
            'kategori_program_id' => $this->kategori_program_id,
        ]);

        session()->flash('message', 'Program berhasil diperbarui.');
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
    public function render()
    {
        $kategori_program = KategoriProgram::all();
        return view('livewire.admin.program.edit', compact('kategori_program'));
    }
}
