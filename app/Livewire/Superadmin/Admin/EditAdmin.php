<?php

namespace App\Livewire\Superadmin\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditAdmin extends Component
{
    use WithFileUploads;

    public $adminId, $name, $email, $foto, $oldFoto;
    public $password = '';

    public function mount($id)
    {
        $this->adminId = $id;
        $this->loadAdmin();
    }

    public function loadAdmin()
    {
        $admin = User::findOrFail($this->adminId);

        $this->name = $admin->name;
        $this->email = $admin->email;
        $this->oldFoto = $admin->foto;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|min:3|max:50,' . $this->adminId,
            'email' => 'required|email',
            'password' => 'nullable|min:8',
        ]);

        $admin = User::findOrFail($this->adminId);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
        ];

        if ($this->password) {
            $data['password'] = bcrypt($this->password);
        }

        if ($this->foto) {
            if ($this->oldFoto && Storage::disk('public')->exists($this->oldFoto)) {
                Storage::disk('public')->delete($this->oldFoto);
            }
            $data['foto'] = $this->foto->store('photos/admin', 'public');
        }

        $admin->update($data);

        return redirect()->route('superadmin.admin.akun-admin');
    }
    public function render()
    {
        return view('livewire.superadmin.admin.edit-admin');
    }
}
