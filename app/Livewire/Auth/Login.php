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
            'nis.required'      => 'NIS wajib diisi',
            'nisn.required'     => 'NISN wajib diisi',
        ];
    }

    public function setRole($role)
    {
        $this->role = $role;
        $this->reset(['email', 'password', 'nis', 'nisn']);
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
        } 
        else {
            // LOGIN SISWA (pakai NIS + NISN)
            $this->validate([
                'nis'  => 'required',
                'nisn' => 'required',
            ]);

            $siswa = Siswa::where('nis', $this->nis)
                          ->where('nisn', $this->nisn)
                          ->first();

            if ($siswa && $siswa->user) {
                Auth::login($siswa->user);
                $this->dispatch('$refresh');
                return redirect()->route('siswa.dashboard');
            }

            $this->addError('nis', 'NIS atau NISN salah / akun belum terdaftar.');
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}