<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ProfilAdmin extends Component
{
    public function render()
    {
        $user = Auth::user()->fresh(); 

        return view('livewire.admin.profil-admin', [
            'user' => $user
        ]);
    }
}