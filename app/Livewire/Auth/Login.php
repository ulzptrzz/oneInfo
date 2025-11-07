<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    #[Layout('components.layouts.app')]

    public $email, $password;

    protected $rules = [
        'email' => 'required',
        'password' => 'required|min:8'
    ];

    protected $messages = [
        'email.required' => 'Email wajib di isi',
        'email.email' => 'Format email tidak valid',
        'password.required' => 'Password wajib diisi',
        'password.min' => 'Password minimal 8 karakter'
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            $user = Auth::user();

            if ($user->role->name === 'superadmin') {
                return redirect()->route('superadmin.dashboard');
            } else if ($user->role->name === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('siswa.dashboard');
            }
        }
    }
    public function render()
    {
        return view('livewire.auth.login');
    }
}
