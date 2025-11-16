<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use App\Models\Siswa as ModelSiswa;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class Siswa implements ToCollection, WithStartRow, WithHeadingRow, WithValidation
{
    public function startRow(): int
    {
        return 2; 
    }

    public function rules(): array
    {
        return [
            '*.nis' => 'required|numeric|unique:siswa,nis',
            '*.nisn' => 'required|numeric|unique:siswa,nisn',
            '*.name' => 'required|string|max:255',
            '*.kelas_id' => 'required|exists:kelas,id',
        ];
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if (!$row['name'] || !$row['nis'] || !$row['nisn']) {
                continue;
            }

            $email = $this->generateEmail($row['name']);
            $emailUnique = $this->getUniqueEmail($email);

            $user = User::firstOrCreate(
                ['email' => $emailUnique],
                [
                    'name' => $row['name'],
                    'password' => Hash::make($row['nisn']),
                    'phone' => '08' . rand(100000000, 999999999),
                    'role_id' => '3',
                ]
            );

            $data = [
                'name'     => $row['name'],
                'nis'      => $row['nis'],
                'nisn'     => $row['nisn'],
                'foto'     => $row['foto'] ?? 'default.png',
                'user_id'  => $user->id,
                'kelas_id' => $row['kelas_id'],
            ];

            $siswa = ModelSiswa::where('name', $row['name'])->first();

            if ($siswa) {
                $siswa->update($data);
            } else {
                ModelSiswa::create($data);
            }
        }
    }
    public function generateEmail($name)
    {
        $name = trim($name);
        if (empty($name)) return '';

        $words = preg_split('/\s+/', $name);
        $words = array_filter($words);
        $count = count($words);

        if ($count === 1) {
            return strtolower($words[0]) . '@smkn1kotabekasi.sch.id';
        }

        $first = strtolower($words[0]);
        $last = strtolower($words[$count - 1]);

        return $first . '.' . $last . '@smkn1kotabekasi.sch.id';
    }

    public function getUniqueEmail($email){
        $emailUnique = $email;
        $counter = 1;

        $parts = explode('@', $email);
        $username = $parts[0];
        $domain = '@' . $parts[1];

        while (User::where('email', $emailUnique)->exists()){
            $emailUnique = $username . $counter . $domain;
            $counter++;
        }

        return $emailUnique;
    }
}
