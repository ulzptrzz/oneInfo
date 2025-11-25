<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EditProfil extends Component
{
    use WithFileUploads; // Trait untuk upload file di Livewire

    // Properti untuk menampung data user
    public $user;
    public $name, $email, $phone, $foto, $old_foto;

    // Properti untuk update password
    public $current_password, $new_password, $new_password_confirmation;

    // Saat komponen di-load
    public function mount()
    {
        $this->user = Auth::user(); // Ambil user yang sedang login

        // Isi form dengan data user
        $this->name  = $this->user->name;
        $this->email = $this->user->email;
        $this->phone = $this->user->phone ?? '';
        $this->old_foto = $this->user->foto; // Simpan foto lama
    }

    // Aturan validasi untuk update profil
    protected function rules()
    {
        return [
            'name'  => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                // Email harus unik kecuali email user sendiri
                Rule::unique('users')->ignore($this->user->id)
            ],
            'phone' => 'nullable|string|max:20',
            'foto'  => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048', // Validasi foto
        ];
    }

    // Custom error message
    protected $messages = [
        'name.required' => 'Nama wajib diisi.',
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.unique' => 'Email sudah digunakan oleh akun lain.',
        'foto.image' => 'File harus berupa gambar.',
        'foto.max' => 'Ukuran maksimal 2MB.',
        'new_password.confirmed' => 'Konfirmasi password tidak cocok.',
    ];

    // Validasi realtime ketika foto berubah
    public function updatedFoto()
    {
        $this->validateOnly('foto');
    }

    // Update data profil user
    public function updateProfile()
    {
        $this->validate(); // Validasi data form

        // Data yang akan diupdate
        $data = [
            'name'  => $this->name,
            'email' => $this->email,
            'phone' => $this->phone ?? null,
        ];

        // Jika user upload foto baru
        if ($this->foto) {

            // Hapus foto lama jika ada
            if ($this->old_foto && Storage::disk('public')->exists($this->old_foto)) {
                Storage::disk('public')->delete($this->old_foto);
            }

            // Simpan foto baru
            $data['foto'] = $this->foto->store('photos/admin', 'public');
        }

        // Update data user di database
        User::where('id', Auth::id())->update($data);

        // Refresh user session agar data terbaru langsung digunakan
        Auth::setUser(User::find(Auth::id()));

        // Refresh komponen Livewire
        $this->dispatch('$refresh');

        // Flash message sukses
        session()->flash('success', 'Profil berhasil diperbarui!');

        // Redirect ke halaman profil
        return redirect()->route('admin.profil');
    }

    // Update password user
    public function updatePassword()
    {
        // Validasi input password
        $this->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed', // Harus sama dengan konfirmasi
        ]);

        // Cek apakah password lama benar
        if (!Hash::check($this->current_password, $this->user->password)) {
            $this->addError('current_password', 'Password lama tidak sesuai.');
            return;
        }

        // Update password baru
        $this->user->update([
            'password' => Hash::make($this->new_password)
        ]);

        // Reset input password
        $this->reset([
            'current_password',
            'new_password',
            'new_password_confirmation'
        ]);

        // Flash message sukses
        session()->flash('password_success', 'Password berhasil diperbarui!');
    }

    // Render view edit-profil.blade.php
    public function render()
    {
        return view('livewire.admin.edit-profil');
    }
}