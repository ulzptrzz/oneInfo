<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;

class Login extends Component
{
    public $email = '';
    public $password = '';
    public $nis = '';
    public $nisn = '';
    public $role = 'siswa';

    protected function messages()
    {
        return [
            'email.required'    => 'Email wajib diisi',
            'email.email'       => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi',
        ];
    }

    public function setRole($role)
    {
        $this->role = $role;
        $this->reset(['email', 'password']);
        $this->resetErrorBag();
    }

    public function login()
    {
        if ($this->role === 'admin') {
            // LOGIN ADMIN & SUPERADMIN
            $this->validate([
                'email'    => 'required|email',
                'password' => 'required',
            ]);

            if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
                $user = Auth::user();
                $roleName = $user->role->name;

                if ($roleName === 'superadmin') {
                    return redirect()->route('superadmin.dashboard');
                }

                if ($roleName === 'admin') {
                    return redirect()->route('admin.dashboard');
                }
            }

            $this->addError('email', 'Email atau password salah.');
        } else {
            // LOGIN SISWA 
            $this->validate([
                'email'    => 'required|email',
                'password' => 'required',
            ]);

            if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
                $user = Auth::user();

                if ($user->role_id === 3 && $user->siswa) {
                    $this->dispatch('$refresh');
                    return redirect()->route('home');
                }
            }

            $this->addError('email', 'email atau nis salah / akun belum terdaftar.');
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}