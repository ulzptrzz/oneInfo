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
    use WithFileUploads;

    public $user;
    public $name, $email, $phone, $foto, $old_foto;
    public $current_password, $new_password, $new_password_confirmation;

    public function mount()
    {
        $this->user = Auth::user();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->phone = $this->user->phone ?? '';
        $this->old_foto = $this->user->foto;
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->user->id)],
            'phone' => 'nullable|string|max:20',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ];
    }

    protected $messages = [
        'name.required' => 'Nama wajib diisi.',
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.unique' => 'Email sudah digunakan oleh akun lain.',
        'foto.image' => 'File harus berupa gambar.',
        'foto.max' => 'Ukuran maksimal 2MB.',
        'new_password.confirmed' => 'Konfirmasi password tidak cocok.',
    ];

    public function updatedFoto()
    {
        $this->validateOnly('foto');
    }

    public function updateProfile()
    {
        $this->validate();

        $data = [
            'name'  => $this->name,
            'email' => $this->email,
            'phone' => $this->phone ?? null,
        ];

        if ($this->foto) {
            if ($this->old_foto && Storage::disk('public')->exists($this->old_foto)) {
                Storage::disk('public')->delete($this->old_foto);
            }
            $data['foto'] = $this->foto->store('photos/admin', 'public');
        }

        User::where('id', Auth::id())->update($data);
        Auth::setUser(User::find(Auth::id()));

        $this->dispatch('$refresh');
        session()->flash('success', 'Profil berhasil diperbarui!');

        return redirect()->route('admin.profil');
    }

    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($this->current_password, $this->user->password)) {
            $this->addError('current_password', 'Password lama tidak sesuai.');
            return;
        }

        $this->user->update(['password' => Hash::make($this->new_password)]);
        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
        session()->flash('password_success', 'Password berhasil diperbarui!');
    }

    public function render()
    {
        return view('livewire.admin.edit-profil');
    }
}
