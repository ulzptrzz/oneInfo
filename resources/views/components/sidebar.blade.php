<aside class="w-64 min-h-screen bg-[#0C356A] text-white p-6 flex flex-col justify-between shadow-lg">
    <!-- Bagian Atas -->
    <div>
        <div class="flex items-center gap-2 mb-6">
            <h1 class="text-xl font-bold tracking-wide">Admin OneInfo</h1>
        </div>
        <hr class="border-gray-500 mb-4">

        <!-- Navigation -->
        <nav class="space-y-2">
            <a href="{{ route('admin.kategori-program') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg font-medium transition duration-200 
                      hover:bg-[#FFC436] hover:text-[#0C356A] group">
                <i class='bx bx-cabinet text-lg text-white group-hover:text-[#0C356A]'></i>
                <span>Kategori</span>
            </a>

            <a href="{{ route('admin.program') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg font-medium transition duration-200 
                      hover:bg-[#FFC436] hover:text-[#0C356A] group">
                <i class='bx bx-receipt text-lg text-white group-hover:text-[#0C356A]'></i>
                <span>Program</span>
            </a>

            <a href="{{ route('admin.perizinan') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg font-medium transition duration-200 
                      hover:bg-[#FFC436] hover:text-[#0C356A] group">
                <i class='bx bx-folder-open text-lg text-white group-hover:text-[#0C356A]'></i>
                <span>Perizinan</span>
            </a>
        </nav>
    </div>
    <livewire:auth.logout />
</aside>
