<?php

namespace App\Livewire\Admin\Dokumentasi;

use Livewire\Component;
use App\Models\Prestasi;
use App\Models\Dokumentasi;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class Edit extends Component
{
    use WithFileUploads;

    public $dokumentasiId;
    public $judul, $video, $prestasi_id;
    public $foto = []; // Foto lama (path string)
    public $newPhotos = []; // Foto baru (UploadedFile)

    protected function rules()
    {
        return [
            'prestasi_id' => 'required|exists:prestasi,id',
            'judul'       => 'required|string|max:255',
            'newPhotos.*' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:3072',
            'video'       => 'nullable|string',
        ];
    }

    protected $messages = [
        'prestasi_id.required' => 'Pilih prestasi terlebih dahulu.',
        'judul.required'       => 'Judul dokumentasi wajib diisi.',
        'newPhotos.*.mimes'    => 'Foto harus format JPG, JPEG, PNG, GIF, atau WEBP.',
        'newPhotos.*.max'      => 'Ukuran foto maksimal 3MB.',
    ];

    public function mount($id)
    {
        $data = Dokumentasi::findOrFail($id);

        $this->dokumentasiId = $data->id;
        $this->prestasi_id = $data->prestasi_id;
        $this->judul = $data->judul;
        $this->video = $data->video;
        
        // Decode JSON foto
        $this->foto = is_string($data->foto) 
            ? json_decode($data->foto, true) ?? [] 
            : $data->foto ?? [];
    }

    // Validasi real-time saat upload
    public function updatedNewPhotos()
    {
        $this->validate([
            'newPhotos.*' => 'image|mimes:jpeg,jpg,png,gif,webp|max:3072',
        ]);
    }

    // Hapus foto lama
    public function removeOldPhoto($index)
    {
        if (isset($this->foto[$index])) {
            // Hapus file dari storage
            Storage::disk('public')->delete($this->foto[$index]);
            
            // Hapus dari array
            unset($this->foto[$index]);
            $this->foto = array_values($this->foto);
        }
    }

    // Hapus foto baru yang belum di-upload
    public function removeNewPhoto($index)
    {
        if (isset($this->newPhotos[$index])) {
            unset($this->newPhotos[$index]);
            $this->newPhotos = array_values($this->newPhotos);
        }
    }

    public function update()
    {
        try {
            // Validasi
            $this->validate();

            // Validasi minimal 1 foto (lama atau baru)
            if (empty($this->foto) && empty($this->newPhotos)) {
                $this->addError('foto', 'Minimal upload 1 foto.');
                return;
            }

            $data = Dokumentasi::findOrFail($this->dokumentasiId);

            // Gabungkan foto lama + foto baru
            $fotoPaths = $this->foto; // Foto lama (sudah berupa path)

            // Upload foto baru
            if (!empty($this->newPhotos)) {
                foreach ($this->newPhotos as $photo) {
                    $path = $photo->store('dokumentasi', 'public');
                    $fotoPaths[] = $path;
                }
            }

            // Update ke database (encode jadi JSON)
            $data->update([
                'prestasi_id' => $this->prestasi_id,
                'judul'       => $this->judul,
                'foto'        => json_encode($fotoPaths), 
                'video'       => $this->video,
            ]);

            // Set flash message
            session()->flash('message', 'Dokumentasi berhasil diperbarui! Total foto: ' . count($fotoPaths));

            // Redirect ke halaman list
            return redirect()->route('admin.dokumentasi');

        } catch (\Exception $e) {
            Log::error('Error update dokumentasi: ' . $e->getMessage());
            $this->addError('general', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.dokumentasi.edit', [
            'prestasis' => Prestasi::with('siswa')->get()
        ]);
    }
}