<?php

namespace App\Livewire\Superadmin\Admin;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;

class CreateAdmin extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $roleId;

    public function mount()
    {
        $role = Role::where('name', 'Admin')->first();
        $this->roleId = $role->id;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama admin wajib diisi',
            'name.min' => 'Nama admin tidak boleh kurang dari 3 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak sesuai',
            'email.unique' => 'Email sudah digunakan',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password tidak boleh kurang dari 8 karakter'
        ];
    }

    public function store()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password), 
            'role_id' => $this->roleId,
            'phone' => '0123456789',
        ]);

        $this->reset(['name', 'email', 'password']);
        return redirect()->route('superadmin.admin.akun-admin');
    }

    public function render()
    {
        return view('livewire.superadmin.admin.create-admin');
    }
}