<?php

namespace App\Livewire\Superadmin\Admin;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;

class AkunAdmin extends Component
{
    public $kelola_admins = [];
    public $confirmDeleteId = null;
    public $showDeleteModal = false;
    public function mount()
    {
        $this->loadAdmins();
    }

    public function loadAdmins()
    {
        $adminRole = Role::where('name', 'Admin')->first();

        if ($adminRole) {
            $this->kelola_admins = User::where('role_id', $adminRole->id)
                ->orderBy('name')
                ->get();
        }
    }

    public function confirmDelete($id)
    {
        $this->confirmDeleteId = $id;
        $this->showDeleteModal = true;
    }

    public function hapus()
    {
        User::findOrFail($this->confirmDeleteId)->delete();
        $this->showDeleteModal = false;
        $this->confirmDeleteId = null;
        $this->loadAdmins();
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->confirmDeleteId = null;
    }

    public function render()
    {
        return view('livewire.superadmin.admin.akun-admin');
    }
}
