<aside class="w-64 min-h-screen bg-[#0C356A] text-white p-6 flex flex-col justify-between shadow-lg">
    <!-- Bagian Atas -->
    <div>
        <div class="flex items-center gap-2 mb-6">
            <h1 class="text-xl font-bold tracking-wide">Siswa OneInfo</h1>
        </div>
        <hr class="border-gray-500 mb-4">

        <!-- Navigation -->
        <nav class="space-y-2">

            <!-- Dashboard -->
            <a href="{{ route('siswa.dashboard') }}"
                class="flex items-center gap-3 px-4 py-2 rounded-lg font-medium transition duration-200
                {{ request()->routeIs('siswa.dashboard') ? 'bg-[#FFC436] text-[#0C356A]' : 'hover:bg-[#FFC436] hover:text-[#0C356A]' }} group">

                <i class='bx bx-home text-lg 
                    {{ request()->routeIs('siswa.dashboard') ? 'text-[#0C356A]' : 'text-white group-hover:text-[#0C356A]' }}'>
                </i>
                <span>Dashboard</span>
            </a>

            <!-- Bookmark -->
            <a href="{{ route('siswa.bookmark') }}"
                class="flex items-center gap-3 px-4 py-2 rounded-lg font-medium transition duration-200
                {{ request()->routeIs('siswa.bookmark') ? 'bg-[#FFC436] text-[#0C356A]' : 'hover:bg-[#FFC436] hover:text-[#0C356A]' }} group">

                <i class='bx bx-bookmark text-lg 
                    {{ request()->routeIs('siswa.bookmark') ? 'text-[#0C356A]' : 'text-white group-hover:text-[#0C356A]' }}'>
                </i>
                <span>Bookmark</span>
            </a>

            <!-- Program -->
            <a href="{{ route('siswa.list-pendaftaran') }}"
                class="flex items-center gap-3 px-4 py-2 rounded-lg font-medium transition duration-200
                {{ request()->routeIs('siswa.list-pendaftaran') ? 'bg-[#FFC436] text-[#0C356A]' : 'hover:bg-[#FFC436] hover:text-[#0C356A]' }} group">

                <i class='bx bx-receipt text-lg 
                    {{ request()->routeIs('siswa.list-pendaftaran') ? 'text-[#0C356A]' : 'text-white group-hover:text-[#0C356A]' }}'>
                </i>
                <span>Program</span>
            </a>
            
            <!-- Profil -->
            <a href="{{ route('siswa.profile') }}"
                class="flex items-center gap-3 px-4 py-2 rounded-lg font-medium transition duration-200
                {{ request()->routeIs('siswa.profile') ? 'bg-[#FFC436] text-[#0C356A]' : 'hover:bg-[#FFC436] hover:text-[#0C356A]' }} group">

                <i class='bx bx-user text-lg 
                    {{ request()->routeIs('siswa.profile') ? 'text-[#0C356A]' : 'text-white group-hover:text-[#0C356A]' }}'>
                </i>
                <span>Profil</span>
            </a>
        </nav>
    </div>

    <div class="mt-6">

        <!-- Home -->
        <a href="{{ route('home') }}"
            class="flex items-center gap-3 px-4 py-2 rounded-lg font-medium transition duration-200 mb-2 border border-white/30
            {{ request()->routeIs('home') ? 'bg-white text-[#0C356A]' : 'hover:bg-white hover:text-[#0C356A]' }} group">

            <i class='bx bx-arrow-back text-lg 
                {{ request()->routeIs('home') ? 'text-[#0C356A]' : 'text-white group-hover:text-[#0C356A]' }}'>
            </i>
            <span>Home</span>
        </a>

        <!-- Logout -->
        <livewire:auth.logout />
    </div>
</aside>
