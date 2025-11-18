<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class EditProfil extends Component
{
    use WithFileUploads;

    public $user;
    public $name;
    public $email;
    public $phone;
    public $foto;
    public $old_foto;
    
    // Password fields
    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->user->id,
            'phone' => 'nullable|string|max:15',
            'foto' => 'nullable|image|max:2048', // 2MB max
        ];
    }

    protected $messages = [
        'name.required' => 'Nama lengkap wajib diisi.',
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.unique' => 'Email sudah digunakan.',
        'phone.max' => 'Nomor telepon maksimal 15 karakter.',
        'foto.image' => 'File harus berupa gambar.',
        'foto.max' => 'Ukuran foto maksimal 2MB.',
    ];

    public function mount()
    {
        $this->user = Auth::user();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->phone = $this->user->phone;
        $this->old_foto = $this->user->foto;
    }

    public function updateProfile()
    {
        $this->validate();

        $fotoPath = $this->old_foto;

        // Handle photo upload
        if ($this->foto) {
            // Delete old photo if exists
            if ($this->old_foto && Storage::disk('public')->exists($this->old_foto)) {
                Storage::disk('public')->delete($this->old_foto);
            }

            // Store new photo
            $fotoPath = $this->foto->store('photos/admin', 'public');
        }

        // Update user data
        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'foto' => $fotoPath,
        ]);

        session()->flash('success', 'Profil berhasil diperbarui!');
        
        // Redirect to profile page
        return redirect()->route('admin.profil');
    }

    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ], [
            'current_password.required' => 'Password lama wajib diisi.',
            'new_password.required' => 'Password baru wajib diisi.',
            'new_password.min' => 'Password baru minimal 8 karakter.',
            'new_password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        // Check current password
        if (!Hash::check($this->current_password, $this->user->password)) {
            $this->addError('current_password', 'Password lama tidak sesuai.');
            return;
        }

        // Update password
        $this->user->update([
            'password' => Hash::make($this->new_password),
        ]);

        // Reset password fields
        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);

        session()->flash('password_success', 'Password berhasil diperbarui!');
    }

    public function render()
    {
        return view('livewire.admin.edit-profil');
    }
}