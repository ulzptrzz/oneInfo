<div>
    <div class="flex min-h-screen">
        <x-sidebar-superadmin />

        <div>
            <div class="flex">
                <div class="text-[#0C356A]">
                    <h2 class="text-xl font-bold ">Kelola Akun Siswa</h2>
                    <p>Kelola akun siswa dengan baik</p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('superadmin.siswa.kelas-siswa') }}"
                        class="flex items-center gap-1 bg-[#0C356A] text-white px-3 py-2 rounded-md hover:bg-[#082d5b] transition">
                        <i class='bx bx-plus'></i> Kelas
                    </a>
                    <a href="{{ route('superadmin.siswa.create-siswa') }}"
                        class="flex items-center gap-1 bg-[#0C356A] text-white px-3 py-2 rounded-md hover:bg-[#082d5b] transition">
                        <i class='bx bx-plus'></i> Siswa
                    </a>
                </div>
            </div>


        </div>
    </div>
</div>
