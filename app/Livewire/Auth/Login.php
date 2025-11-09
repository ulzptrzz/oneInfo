<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

class Login extends Component
{
    #[Layout('components.layouts.app')]

    public $email, $password;
    public $nis, $nisn;
    public $role = 'admin'; 
    protected $messages = [
        'email.required' => 'Email wajib di isi',
        'email.email' => 'Format email tidak valid',
        'password.required' => 'Password wajib diisi',
        'password.min' => 'Password minimal 8 karakter',
        'nis.required' => 'NIS wajib diisi',
        'nisn.required' => 'NISN wajib diisi',
    ];

    public function setRole($role)
    {
        $this->role = $role;
        $this->reset(['email', 'password', 'nis', 'nisn']);
    }

    public function login()
    {
        if ($this->role === 'admin') {
            $this->validate([
                'email' => 'required|email',
                'password' => 'required|min:8',
            ]);

            if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
                $user = Auth::user();

                if ($user->role->name === 'superadmin') {
                    return redirect()->route('superadmin.dashboard');
                } elseif ($user->role->name === 'admin') {
                    return redirect()->route('admin.dashboard');
                } 
            } else {
                $this->addError('email', 'Email atau password salah.');
            }
        } else {
            // mode siswa
            $this->validate([
                'nis' => 'required',
                'nisn' => 'required',
            ]);

            if (Auth::attempt(['nis' => $this->nis, 'nisn' => $this->nisn])) {
                return redirect()->route('siswa.dashboard');
            } else {
                $this->addError('nis', 'NIS atau NISN salah.');
            }
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
