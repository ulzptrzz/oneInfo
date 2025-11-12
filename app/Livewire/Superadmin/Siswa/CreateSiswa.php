<?php

namespace App\Livewire\Superadmin\Siswa;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CreateSiswa extends Component
{
    use WithFileUploads;

    public $name = '';
    public $nis = '';
    public $nisn = '';
    public $foto = '';
    public $kelas_id = '';

    public $kelas_siswa;

    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:50',
            'nis' => 'required',
            'nisn' => 'required',
            'foto' => 'required|image|max:2048',
            'kelas_id' => 'required|exists:kelas,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama siswa wajib diisi',
            'name.min' => 'Nama siswa tidak boleh kurang dari 3 karakter',
            'name.max' => 'Nama siswa tidak boleh melebihi 50 karakter',
            'nis.required' => 'NIS wajib diisi',
            'nisn.required' => 'NISN wajib diisi',
            'foto.required' => 'Foto wajib diunggah',
            'foto.max' => 'Ukuran foto tidak boleh melebihi 2 MB',
            'kelas_id.required' => 'Kelas wajib diisi',
        ];
    }

    public function mount()
    {
        $this->kelas_siswa = Kelas::all();
    }

    public function store()
    {
        $this->validate();

        $photo = $this->foto ? $this->foto->store('siswa', 'public') : null;

        $user = User::create([
            'name' => $this->name,
            'email' => $this->nis . '@siswa.com', 
            'phone' => '08' . rand(100000000, 999999999),
            'password' => Hash::make($this->nisn),
            'role_id' => 3
        ]);

        Siswa::create([
            'name' => $this->name,
            'nis' => $this->nis,
            'nisn' => $this->nisn,
            'foto' => $photo,
            'kelas_id' => $this->kelas_id,
            'user_id' => $user->id,
        ]);
        
        // Reset form
        $this->reset();

        return redirect()->route('superadmin.siswa.akun-siswa');
    }

    public function render()
    {
        return view('livewire.superadmin.siswa.create-siswa');
    }
}
