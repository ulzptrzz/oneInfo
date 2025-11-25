<?php

namespace App\Livewire\Superadmin\Siswa;

use App\Models\Siswa;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Siswa as ImportSiswa;

class AkunSiswa extends Component
{
    use WithFileUploads;

    public $sesions = [];
    public $fileExcel;
    public $confirmDeleteId = null;
    public $showDeleteModal = false;
    public $showExcelModal = false;

    protected $listeners = ['cancelDelete'];

    protected function rules()
    {
        return [
            'fileExcel' => 'required|file|mimes:xlsx,xls|max:10240', // max 10MB
        ];
    }

    protected function messages()
    {
        return [
            'fileExcel.required'          => 'File Excel wajib diupload.',
            'fileExcel.file'              => 'File yang dipilih tidak valid.',
            'fileExcel.mimes'             => 'File harus berupa Excel dengan ekstensi .xlsx atau .xls saja.',
            'fileExcel.max'               => 'Ukuran file maksimal 10MB.',
        ];
    }

    public function openExcelModal()
    {
        $this->showExcelModal = true;
        $this->resetErrorBag();
        $this->fileExcel = null;
    }

    public function closeExcelModal()
    {
        $this->showExcelModal = false;
        $this->fileExcel = null;
        $this->resetErrorBag();
    }

    public function importExcel()
    {
        $this->validate();

        try {
            Excel::import(new ImportSiswa, $this->fileExcel);

            $this->closeExcelModal();
            $this->loadData();

            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => 'Berhasil mengimport 500 siswa!'
            ]);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errors = [];

            foreach ($failures as $failure) {
                $row = $failure->row();
                $attribute = $failure->attribute();
                $errorMsg = $failure->errors()[0] ?? 'Invalid data';

                $errors[] = "Baris {$row} ({$attribute}): {$errorMsg}";
            }

            $this->addError('fileExcel', implode('<br>', $errors));
        } catch (\Exception $e) {
            $this->addError('fileExcel', 'Gagal import: ' . $e->getMessage());
        }
    }
    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->sesions = Siswa::orderBy('name', 'desc')->get();
    }

    public function confirmDelete($id)
    {
        $this->confirmDeleteId = $id;
        $this->showDeleteModal = true;
    }

    public function hapus()
    {
        Siswa::findOrFail($this->confirmDeleteId)->delete();
        $this->showDeleteModal = false;
        $this->confirmDeleteId = null;
        $this->loadData();
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->confirmDeleteId = null;
    }
    public function render()
    {
        return view('livewire.superadmin.siswa.akun-siswa');
    }
}
