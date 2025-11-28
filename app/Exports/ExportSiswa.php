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
        return Siswa::with('kelas')
            ->join('kelas', 'kelas.id', '=', 'siswa.kelas_id')
            ->orderBy('kelas.tahun_ajaran', 'asc')
            ->select('siswa.*')
            ->get();
    }

    public function headings(): array {
        return ['No', 'Nama Siswa', 'Email', 'NIS', 'NISN', 'Tingkat','Jurusan', 'Kelas', 'Tahun Ajaran','Foto'];
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
            $siswa->kelas?->tingkat ?? '',
            $siswa->kelas->jurusan->nama_jurusan ?? '',
            $siswa->kelas?->nama_kelas ?? '',
            $siswa->kelas?->tahun_ajaran ?? '',
            $siswa->foto ? 'storage/' . $siswa->foto : ''
        ];
    }
}
