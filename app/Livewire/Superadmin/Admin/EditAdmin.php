<?php

namespace App\Livewire\Superadmin\Admin;

use App\Models\User;
use Livewire\Component;

class EditAdmin extends Component
{
    public $adminId, $name, $email;
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
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|min:3|max:50,' . $this->adminId,
            'email' => 'required|email',
            'password' => 'nullable|min:8'
        ]);

        $admin = User::findOrFail($this->adminId);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
        ];

        if ($this->password) {
            $data['password'] = bcrypt($this->password);
        }

        $admin->update($data);

        return redirect()->route('superadmin.admin.akun-admin');
    }
    public function render()
    {
        return view('livewire.superadmin.admin.edit-admin');
    }
}
