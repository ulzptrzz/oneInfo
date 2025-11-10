<aside class="w-64 min-h-screen bg-[#0C356A] text-white p-6 flex flex-col justify-between shadow-lg">
    <!-- Bagian Atas -->
    <div>
        <div class="flex items-center gap-2 mb-6">
            <h1 class="text-xl font-bold tracking-wide">Superadmin OneInfo</h1>
        </div>
        <hr class="border-gray-500 mb-4">

        <!-- Navigation -->
        <nav class="space-y-2">
            <a href="{{ route('superadmin.dashboard') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg font-medium transition duration-200 
               hover:bg-[#FFC436] hover:text-[#0C356A] group">
               <i class='bx bx-home text-lg text-white group-hover:text-[#0C356A]'></i>
               <span>Dashboard</span>
            </a>
            <a href="{{ route('superadmin.admin.akun-admin') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg font-medium transition duration-200 
               hover:bg-[#FFC436] hover:text-[#0C356A] group">
               <i class='bx bxs-user text-lg text-white group-hover:text-[#0C356A]'></i>
               <span>Kelola Admin</span>
            </a>

            <a href="{{ route('superadmin.siswa.akun-siswa') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg font-medium transition duration-200 
                      hover:bg-[#FFC436] hover:text-[#0C356A] group">
                <i class='bx bx-child text-lg text-white group-hover:text-[#0C356A]'></i>
                <span>Kelola Siswa</span>
            </a>

           
        </nav>
    </div>
    <livewire:auth.logout />
</aside>
