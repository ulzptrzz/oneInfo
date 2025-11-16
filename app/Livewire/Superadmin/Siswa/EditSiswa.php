<?php

namespace App\Livewire\Superadmin\Siswa;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EditSiswa extends Component
{
    use WithFileUploads;

    public $siswa_id, $name, $nis, $nisn, $foto, $kelas_id, $kelas_siswa;

    public $oldFoto;

    public function mount($id)
    {
        $siswa = Siswa::findOrFail($id);

        $this->siswa_id = $siswa->id;
        $this->name = $siswa->name;
        $this->nis = $siswa->nis;
        $this->nisn = $siswa->nisn;
        $this->kelas_id = $siswa->kelas_id;
        $this->oldFoto = $siswa->foto;

        $this->kelas_siswa = Kelas::all();
    }

    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:50',
            'nis' => 'required',
            'nisn' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
            'foto' => 'nullable|image|max:2048',
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
            'kelas_id.required' => 'Kelas wajib diisi',
            'foto.max' => 'Ukuran foto tidak boleh melebihi 2 MB',
        ];
    }

    public function update()
    {
        $this->validate();

        $siswa = Siswa::findOrFail($this->siswa_id);

        if ($this->foto) {
            if ($siswa->foto && Storage::disk('public')->exists($siswa->foto)) {
                Storage::disk('public')->delete($siswa->foto);
            }

            $photoPath = $this->foto->store('siswa', 'public');
        } else {
            $photoPath = $siswa->foto;
        }

        $email = $this->generateEmail($this->name);
        $emailUnique = $this->getUniqueEmail($email, $siswa->user->id ?? null);

        $siswa->user?->update([
            'name' => $this->name,
            'email' => $emailUnique,
            'password' => Hash::make($this->nisn),
        ]);


        $siswa->update([
            'name' => $this->name,
            'nis' => $this->nis,
            'nisn' => $this->nisn,
            'foto' => $photoPath,
            'kelas_id' => $this->kelas_id,
        ]);

        return redirect()->route('superadmin.siswa.akun-siswa');
    }

    public function generateEmail($name)
    {
        $name = trim($name);
        $words = preg_split('/\s+/', $name);
        $words = array_filter($words);
        $count = count($words);

        if ($count === 1) {
            return strtolower($words[0]) . '@smkn1kotabekasi.sch.id';
        }

        $first = strtolower($words[0]);
        $last = strtolower($words[$count - 1]);

        return $first . '.' . $last . '@smkn1kotabekasi.sch.id';
    }

    public function getUniqueEmail($email, $currentUserId = null)
    {
        $emailUnique = $email;
        $counter = 1;

        $parts = explode('@', $email);
        $username = $parts[0];
        $domain = '@' . $parts[1];

        while (
            User::where('email', $emailUnique)
            ->when($currentUserId, fn($q) => $q->where('id', '!=', $currentUserId))
            ->exists()
        ) {
            $emailUnique = $username . $counter . $domain;
            $counter++;
        }

        return $emailUnique;
    }

    public function render()
    {
        return view('livewire.superadmin.siswa.edit-siswa');
    }
}
