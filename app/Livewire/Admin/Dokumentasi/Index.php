<?php

namespace App\Livewire\Admin\Dokumentasi;

use App\Models\Dokumentasi;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    // Variabel untuk proses konfirmasi hapus
    public $confirmDeleteId = null;
    public $showDeleteModal = false;

    // Pas tombol hapus diklik muncul modal konfirmasi
    public function confirmDelete($id)
    {
        $this->confirmDeleteId = $id;
        $this->showDeleteModal = true;
    }

    // Eksekusi hapus data
    public function hapus()
    {
        $dokumentasi = Dokumentasi::findOrFail($this->confirmDeleteId);
        
        // Decode foto JSON dan hapus file dari storage
        $foto = is_string($dokumentasi->foto) 
            ? json_decode($dokumentasi->foto, true) ?? [] 
            : $dokumentasi->foto ?? [];
        
        foreach ($foto as $path) {
            Storage::disk('public')->delete($path);
        }
        
        // Hapus data dari database
        $dokumentasi->delete();

        $this->showDeleteModal = false; // Tutup modal
        $this->confirmDeleteId = null; // Reset id
        
        session()->flash('message', 'Dokumentasi berhasil dihapus.');
    }

    // Kalau user batal
    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->confirmDeleteId = null;
    }

    // Tampilkan halaman index
    public function render()
    {
        // Ambil data dokumentasi dengan relasi prestasi dan siswa
        $dokumentasi = Dokumentasi::with(['prestasi.siswa'])->latest()->get();
        
        return view('livewire.admin.dokumentasi.index', [
            'dokumentasi' => $dokumentasi,
        ]);
    }
}