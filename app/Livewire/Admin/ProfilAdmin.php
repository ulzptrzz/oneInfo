<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ProfilAdmin extends Component
{
    public $user;

    public function mount()
    {
        $this->user  = Auth::user();

    }
    public function render()
    {
        return view('livewire.admin.profil-admin');
    }
}
