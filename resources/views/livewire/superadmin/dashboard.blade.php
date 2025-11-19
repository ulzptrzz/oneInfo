<div>
    <div class="flex min-h-screen">
        <x-sidebar-superadmin />
        <div class="p-8">
            <div class="bg-gradient-to-r from-[#0C356A] to-[#1e40af] rounded-2xl shadow-xl p-8 text-white mb-5">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-4xl font-bold mb-2">Selamat Datang, Superadmin!</h1>
                        <p class="text-blue-100 text-lg">Di Dashboard OneInfo.id</p>
                        <p class="text-blue-200 text-sm mt-1">Kelola semua konten dan informasi sekolah dengan mudah</p>
                    </div>
                    <div class="hidden md:block">
                        <div class="w-32 h-32 bg-[#FFC436] rounded-full flex items-center justify-center">
                            <i class='bx bxs-dashboard text-6xl text-[#0C356A]'></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <p class="text-gray-600 text-sm font-medium mb-1">Total Admin</p>
                            <h3 class="text-3xl font-bold text-[#0C356A]">{{ $jumlahAdmin ?? '0' }}</h3>
                        </div>
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                            <i class='bx bx-user text-3xl text-white'></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <p class="text-gray-600 text-sm font-medium mb-1">Total Siswa</p>
                            <h3 class="text-3xl font-bold text-[#0C356A]">{{ $jumlahSiswa ?? '0' }}</h3>
                        </div>
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                            <i class='bx bx-child text-3xl text-white'></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <p class="text-gray-600 text-sm font-medium mb-1">Total Kelas</p>
                            <h3 class="text-3xl font-bold text-[#0C356A]">{{ $jumlahKelas ?? '0' }}</h3>
                        </div>
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                            <i class='bx bx-door-open text-3xl text-white'></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <p class="text-gray-600 text-sm font-medium mb-1">Total Jurusan</p>
                            <h3 class="text-3xl font-bold text-[#0C356A]">{{ $jumlahJurusan ?? '0' }}</h3>
                        </div>
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                            <i class='bx bxs-school text-3xl text-white'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
