<aside class="w-64 min-h-screen bg-[#0C356A] text-white p-6 flex flex-col justify-between shadow-lg">
    <!-- Bagian Atas -->
    <div>
        <div class="flex items-center gap-2 mb-6">
            <h1 class="text-xl font-bold tracking-wide">Admin OneInfo</h1>
        </div>
        <hr class="border-gray-500 mb-4">

        <!-- Navigation -->
        <nav class="space-y-2">
            <a href="{{ route('admin.program') }}"
                class="flex items-center gap-3 px-4 py-2 rounded-lg font-medium transition duration-200
                {{ request()->routeIs('admin.program') ? 'bg-[#FFC436] text-[#0C356A]' : 'hover:bg-[#FFC436] hover:text-[#0C356A]' }} group">

                <i class='bx bx-receipt text-lg 
                    {{ request()->routeIs('admin.program') ? 'text-[#0C356A]' : 'text-white group-hover:text-[#0C356A]' }}'>
                </i>
                <span>Program</span>
            </a>

            <a href="{{ route('admin.dokumentasi') }}"
                class="flex items-center gap-3 px-4 py-2 rounded-lg font-medium transition duration-200
                {{ request()->routeIs('admin.dokumentasi') ? 'bg-[#FFC436] text-[#0C356A]' : 'hover:bg-[#FFC436] hover:text-[#0C356A]' }} group">

                <i class='bx bx-camera text-lg 
                    {{ request()->routeIs('admin.dokumentasi') ? 'text-[#0C356A]' : 'text-white group-hover:text-[#0C356A]' }}'>
                </i>
                <span>Dokumentasi</span>
            </a>

            <a href="{{ route('admin.prestasi') }}"
                class="flex items-center gap-3 px-4 py-2 rounded-lg font-medium transition duration-200
                {{ request()->routeIs('admin.prestasi') ? 'bg-[#FFC436] text-[#0C356A]' : 'hover:bg-[#FFC436] hover:text-[#0C356A]' }} group">

                <i class='bx bx-medal text-lg 
                    {{ request()->routeIs('admin.prestasi') ? 'text-[#0C356A]' : 'text-white group-hover:text-[#0C356A]' }}'>
                </i>
                <span>Prestasi</span>
            </a>

            <a href="{{ route('admin.artikel') }}"
                class="flex items-center gap-3 px-4 py-2 rounded-lg font-medium transition duration-200
                {{ request()->routeIs('admin.artikel') ? 'bg-[#FFC436] text-[#0C356A]' : 'hover:bg-[#FFC436] hover:text-[#0C356A]' }} group">

                <i class='bx bx-news text-lg 
                    {{ request()->routeIs('admin.artikel') ? 'text-[#0C356A]' : 'text-white group-hover:text-[#0C356A]' }}'>
                </i>
                <span>Artikel</span>
            </a>

            <a href="{{ route('list-pendaftaran-program') }}"
                class="flex items-center gap-3 px-4 py-2 rounded-lg font-medium transition duration-200
                {{ request()->routeIs('list-pendaftaran-program') ? 'bg-[#FFC436] text-[#0C356A]' : 'hover:bg-[#FFC436] hover:text-[#0C356A]' }} group">

                <i class='bx bx-file text-lg 
                    {{ request()->routeIs('list-pendaftaran-program') ? 'text-[#0C356A]' : 'text-white group-hover:text-[#0C356A]' }}'>
                </i>
                <span>Pendaftaran</span>
            </a>

            <a href="{{ route('admin.profil') }}"
                class="flex items-center gap-3 px-4 py-2 rounded-lg font-medium transition duration-200
                {{ request()->routeIs('admin.profil') ? 'bg-[#FFC436] text-[#0C356A]' : 'hover:bg-[#FFC436] hover:text-[#0C356A]' }} group">

                <i class='bx bx-user text-lg 
                    {{ request()->routeIs('admin.profil') ? 'text-[#0C356A]' : 'text-white group-hover:text-[#0C356A]' }}'>
                </i>
                <span>Profile</span>
            </a>
            
        </nav>
    </div>
    <livewire:auth.logout />
    
</aside>