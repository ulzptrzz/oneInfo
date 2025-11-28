<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportSiswa implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        return Siswa::with(['user', 'kelas'])->get();
    }

    public function headings(): array {
        return ['No', 'Nama Siswa', 'Email', 'NIS', 'NISN', 'Kelas', 'Foto'];
    }

    public function map($siswa): array {
        static $no = 0;
        $no++;
        return [
            $no,
            $siswa->name,
            $siswa->user->email ?? '',
            $siswa->nis,
            $siswa->nisn,
            $siswa->kelas?->nama_kelas ?? '',
            $siswa->foto ? 'storage/' . $siswa->foto : ''
        ];
    }
}
