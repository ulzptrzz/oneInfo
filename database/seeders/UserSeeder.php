<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Jurusan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Role
        $superadmin = Role::firstOrCreate(['name' => 'superadmin']);
        $admin      = Role::firstOrCreate(['name' => 'admin']);
        $siswaRole  = Role::firstOrCreate(['name' => 'siswa']);
        $jurusan_Rpl = Jurusan::firstOrCreate([
            'nama_jurusan' => 'Rekayasa Perangkat Lunak',
            'deskripsi' => 'mempelajari prinsip dan teknik untuk merancang, mengembangkan, menguji, dan memelihara perangkat lunak atau aplikasi'
        ]);
        $jurusan_Tkj = Jurusan::firstOrCreate([
            'nama_jurusan' => 'Teknik Komputer Dan Jaringan',
            'deskripsi' => 'mendalami perakitan, pengoperasian, dan pemeliharaan perangkat keras komputer serta perancangan dan pengelolaan jaringan komputer'
        ]);
        $jurusan_Dkv = Jurusan::firstOrCreate([
            'nama_jurusan' => 'Desain Komunikasi Visual',
            'deskripsi' => ' mempelajari cara menyampaikan pesan secara kreatif melalui media visual, seperti logo, poster, ilustrasi, desain grafis, animasi, dan desain web'
        ]);

        // 2. Kelas
        $kelasX   = Kelas::firstOrCreate([
            'nama_kelas'   => 'A',
            'jurusan_id'      => $jurusan_Rpl->id,
            'tingkat'      => 'X',
            'tahun_ajaran' => '2025',
        ]);

        $kelasXI  = Kelas::firstOrCreate([
            'nama_kelas'   => 'B',
            'jurusan_id'      => $jurusan_Tkj->id,
            'tingkat'      => 'XI',
            'tahun_ajaran' => '2025',
        ]);

        $kelasXII = Kelas::firstOrCreate([
            'nama_kelas'   => 'A',
            'jurusan_id'      => $jurusan_Dkv->id,
            'tingkat'      => 'XII',
            'tahun_ajaran' => '2025',
        ]);

        // 3. Superadmin & Admin
        User::firstOrCreate(['email' => 'superadmin@gmail.com'], [
            'name'     => 'Superadmin',
            'email'    => 'superadmin@gmail.com',
            'phone'    => '081234567890',
            'password' => Hash::make('super12345'),
            'role_id'  => $superadmin->id,
            'foto'     => 'default.jpg'
        ]);

        User::firstOrCreate(['email' => 'admin@gmail.com'], [
            'name'     => 'Admin Sekolah',
            'email'    => 'admin@gmail.com',
            'phone'    => '081234567891',
            'password' => Hash::make('admin12345'),
            'role_id'  => $admin->id,
            'foto'     => 'default.jpg'
        ]);

        $siswaTerpilih = [
            [
                'name' => 'Aulia Putri',
                'nis' => '232410223',
                'nisn' => '0087318117',
                'kelas_id' => $kelasXII->id,
                'email' => 'aulia.putri@smkn1kotabekasi.sch.id'
            ],
            [
                'name' => 'Shakila Putri Maisya',
                'nis' => '232410274',
                'nisn' => '0087318200',
                'kelas_id' => $kelasXI->id,
                'email' => 'shakila.maisya@smkn1kotabekasi.sch.id'
            ]
        ];

        foreach ($siswaTerpilih as $item) {
            $user = User::where('email', $item['email'])->first();

            if (!$user) {
                $user = User::create([
                    'name'     => $item['name'],
                    'email'    => $item['email'],
                    'phone'    => '08' . rand(100000000, 999999999),
                    'password' => Hash::make($item['nisn']),
                    'role_id'  => $siswaRole->id,
                    'foto'     => 'default.jpg'
                ]);
            }

            Siswa::firstOrCreate(
                ['nis' => $item['nis']],
                [
                    'name'      => $item['name'],
                    'nisn'      => $item['nisn'],
                    'foto'      => 'default.jpg',
                    'kelas_id'  => $item['kelas_id'],
                    'user_id'   => $user->id,
                ]
            );
        }

        // 4. Data Siswa
        $dataSiswa = [
            ['name' => 'Nurhaliza maya',   'nis' => '20250002', 'nisn' => '0051234568', 'kelas_id' => $kelasX->id],
            ['name' => 'Rina Melati',      'nis' => '20241001', 'nisn' => '0041234567', 'kelas_id' => $kelasXI->id],
            ['name' => 'Nadia Cahyani',    'nis' => '20232004', 'nisn' => '0031234570', 'kelas_id' => $kelasXII->id],
            ['name' => 'Nadia Cahyani',    'nis' => '20232003', 'nisn' => '0031234520', 'kelas_id' => $kelasXI->id],
        ];

        foreach ($dataSiswa as $item) {

            $email = $this->generateEmail($item['name']);
            $emailUnique = $this->getUniqueEmail($email);

            $user = User::create([
                'name'     => $item['name'],
                'email'    => $emailUnique,
                'phone'    => '08' . rand(100000000, 999999999),
                'password' => Hash::make($item['nisn']),
                'role_id'  => $siswaRole->id,
                'foto'     => 'default.jpg'
            ]);

            Siswa::create([
                'name'      => $item['name'],
                'nis'       => $item['nis'],
                'nisn'      => $item['nisn'],
                'foto'      => 'default.jpg',
                'kelas_id'  => $item['kelas_id'],
                'user_id'   => $user->id,
            ]);
        }
    }
    private function generateEmail($name)
    {
        $name = trim($name);
        $words = preg_split('/\s+/', $name);
        $words = array_filter($words);
        $count = count($words);

        if ($count === 1) {
            return strtolower($words[0]) . '@smkn1kotabekasi.sch.id';
        }

        $first = strtolower($words[0]);
        $last  = strtolower($words[$count - 1]);

        return $first . '.' . $last . '@smkn1kotabekasi.sch.id';
    }

    public function getUniqueEmail($email)
    {
        $emailUnique = $email;
        $counter = 1;

        $parts = explode('@', $email);
        $username = $parts[0];
        $domain = '@' . $parts[1];

        while (User::where('email', $emailUnique)->exists()) {
            $emailUnique = $username . $counter . $domain;
            $counter++;
        }

        return $emailUnique;
    }
}
