<div>
    {{-- Mobile Hamburger Button --}}
    <button @click="$store.sidebar.toggle()" 
            class="lg:hidden fixed top-4 left-4 z-50 bg-[#0C356A] text-white p-3 rounded-lg shadow-lg hover:bg-[#ffc436] hover:text-[#0C356A] transition">
        <i class='bx bx-menu text-2xl'></i>
    </button>

    {{-- Overlay (Mobile) --}}
    <div x-show="$store.sidebar.isOpen" 
         @click="$store.sidebar.close()"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="lg:hidden fixed inset-0 bg-black/50 z-40"
         style="display: none;">
    </div>

    <div class="flex min-h-screen bg-gray-50">
        
        {{-- Sidebar --}}
        <aside x-show="$store.sidebar.isOpen || window.innerWidth >= 1024"
               x-transition:enter="lg:transition-none transition ease-out duration-300"
               x-transition:enter-start="-translate-x-full"
               x-transition:enter-end="translate-x-0"
               x-transition:leave="lg:transition-none transition ease-in duration-200"
               x-transition:leave-start="translate-x-0"
               x-transition:leave-end="-translate-x-full"
               class="fixed lg:static inset-y-0 left-0 z-40 w-64 min-h-screen bg-[#0C356A] text-white p-6 flex flex-col justify-between shadow-lg">
            
            {{-- Bagian Atas --}}
            <div>
                {{-- Logo & Title --}}
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-[#ffc436] rounded-lg flex items-center justify-center">
                        <i class='bx bx-book-reader text-[#0C356A] text-2xl'></i>
                    </div>
                    <h1 class="text-xl font-bold tracking-wide">Siswa OneInfo</h1>
                </div>
                <hr class="border-gray-500 mb-4">

                {{-- Navigation --}}
                <nav class="space-y-2">

                    {{-- Dashboard --}}
                    <a href="{{ route('siswa.dashboard') }}"
                       @click="$store.sidebar.close()"
                        class="flex items-center gap-3 px-4 py-2 rounded-lg font-medium transition duration-200
                        {{ request()->routeIs('siswa.dashboard') ? 'bg-[#FFC436] text-[#0C356A]' : 'hover:bg-[#FFC436] hover:text-[#0C356A]' }} group">
                        <i class='bx bx-home text-lg 
                            {{ request()->routeIs('siswa.dashboard') ? 'text-[#0C356A]' : 'text-white group-hover:text-[#0C356A]' }}'>
                        </i>
                        <span>Dashboard</span>
                    </a>

                    {{-- Bookmark --}}
                    <a href="{{ route('siswa.bookmark') }}"
                       @click="$store.sidebar.close()"
                        class="flex items-center gap-3 px-4 py-2 rounded-lg font-medium transition duration-200
                        {{ request()->routeIs('siswa.bookmark') ? 'bg-[#FFC436] text-[#0C356A]' : 'hover:bg-[#FFC436] hover:text-[#0C356A]' }} group">
                        <i class='bx bx-bookmark text-lg 
                            {{ request()->routeIs('siswa.bookmark') ? 'text-[#0C356A]' : 'text-white group-hover:text-[#0C356A]' }}'>
                        </i>
                        <span>Bookmark</span>
                    </a>

                    {{-- Program --}}
                    <a href="{{ route('siswa.list-pendaftaran') }}"
                       @click="$store.sidebar.close()"
                        class="flex items-center gap-3 px-4 py-2 rounded-lg font-medium transition duration-200
                        {{ request()->routeIs('siswa.list-pendaftaran') ? 'bg-[#FFC436] text-[#0C356A]' : 'hover:bg-[#FFC436] hover:text-[#0C356A]' }} group">
                        <i class='bx bx-receipt text-lg 
                            {{ request()->routeIs('siswa.list-pendaftaran') ? 'text-[#0C356A]' : 'text-white group-hover:text-[#0C356A]' }}'>
                        </i>
                        <span>Program</span>
                    </a>

                    {{-- Profil --}}
                    <a href="{{ route('siswa.profile') }}"
                       @click="$store.sidebar.close()"
                        class="flex items-center gap-3 px-4 py-2 rounded-lg font-medium transition duration-200
                        {{ request()->routeIs('siswa.profile') ? 'bg-[#FFC436] text-[#0C356A]' : 'hover:bg-[#FFC436] hover:text-[#0C356A]' }} group">
                        <i class='bx bx-user text-lg 
                            {{ request()->routeIs('siswa.profile') ? 'text-[#0C356A]' : 'text-white group-hover:text-[#0C356A]' }}'>
                        </i>
                        <span>Profil</span>
                    </a>

                </nav>
            </div>

            {{-- Bagian Bawah --}}
            <div class="mt-6">

                {{-- Home --}}
                <a href="{{ route('home') }}"
                   @click="$store.sidebar.close()"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg font-medium transition duration-200 mb-2 border border-white/30
                    {{ request()->routeIs('home') ? 'bg-white text-[#0C356A]' : 'hover:bg-white hover:text-[#0C356A]' }} group">
                    <i class='bx bx-arrow-back text-lg 
                        {{ request()->routeIs('home') ? 'text-[#0C356A]' : 'text-white group-hover:text-[#0C356A]' }}'>
                    </i>
                    <span>Home</span>
                </a>

                {{-- Logout --}}
                <div @click="$store.sidebar.close()">
                    <livewire:auth.logout />
                </div>
            </div>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 w-full p-4 md:p-8 pt-20 lg:pt-8">
            
            {{-- Profile Container --}}
            <div class="max-w-5xl mx-auto">
                
                {{-- Cover Image / Header --}}
                <div class="bg-gradient-to-r from-[#0C356A] to-[#1e40af] h-48 md:h-64 rounded-t-2xl relative">
                    <div class="absolute inset-0 bg-black/10"></div>
                </div>

                {{-- Profile Card --}}
                <div class="bg-white rounded-b-2xl shadow-lg -mt-20 md:-mt-24 relative">
                    
                    {{-- Profile Header --}}
                    <div class="px-6 md:px-10 pb-6">
                        
                        {{-- Avatar & Basic Info --}}
                        <div class="flex flex-col md:flex-row md:items-end gap-6 mb-6">
                            
                            {{-- Profile Photo --}}
                            <div class="relative -mt-16 md:-mt-20">
                                <div class="w-32 h-32 md:w-40 md:h-40 rounded-full overflow-hidden ring-4 ring-white shadow-xl bg-gray-100">
                                    @if($user->siswa->foto)
                                        <img src="{{ asset('storage/' . $user->siswa->foto) }}" 
                                             alt="{{ $user->name }}"
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-[#0C356A] to-[#1e40af]">
                                            <i class='bx bx-user text-white text-6xl'></i>
                                        </div>
                                    @endif
                                </div>
                                {{-- Status Badge --}}
                                <div class="absolute bottom-2 right-2 w-6 h-6 bg-green-500 border-4 border-white rounded-full"></div>
                            </div>

                            {{-- Name & Info --}}
                            <div class="flex-1 md:mb-4">
                                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">
                                    {{ $user->name }}
                                </h1>
                                <p class="text-gray-600 flex items-center gap-2 mb-3">
                                    <i class='bx bx-envelope'></i>
                                    {{ $user->email }}
                                </p>
                                <div class="flex flex-wrap gap-2">
                                    <span class="inline-flex items-center gap-1 bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">
                                        <i class='bx bx-briefcase'></i>
                                        Siswa Aktif
                                    </span>
                                    <span class="inline-flex items-center gap-1 bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm font-medium">
                                        <i class='bx bx-building'></i>
                                        SMKN 1 Kota Bekasi
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Tabs/Navigation --}}
                        <div class="border-b border-gray-200">
                            <div class="flex gap-6 overflow-x-auto">
                                <button class="px-4 py-3 text-[#0C356A] border-b-2 border-[#0C356A] font-semibold whitespace-nowrap">
                                    Informasi Pribadi
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Profile Content --}}
                    <div class="px-6 md:px-10 py-6">
                        
                        {{-- Personal Information Section --}}
                        <div class="space-y-6">
                            
                            <h2 class="text-xl font-bold text-gray-900 mb-4">Informasi Pribadi</h2>

                            {{-- Info Grid --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                
                                {{-- NISN --}}
                                <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                    <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class='bx bx-id-card text-white text-2xl'></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm text-gray-600 mb-1">NISN</p>
                                        <p class="text-lg font-semibold text-gray-900">00{{ $user->siswa->nisn }}</p>
                                    </div>
                                </div>

                                {{-- NIS --}}
                                <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                    <div class="w-12 h-12 bg-purple-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class='bx bx-credit-card text-white text-2xl'></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm text-gray-600 mb-1">NIS</p>
                                        <p class="text-lg font-semibold text-gray-900">{{ $user->siswa->nis }}</p>
                                    </div>
                                </div>

                                {{-- Kelas --}}
                                <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                    <div class="w-12 h-12 bg-yellow-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class='bx bx-book-alt text-white text-2xl'></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm text-gray-600 mb-1">Kelas</p>
                                        <p class="text-lg font-semibold text-gray-900">
                                            {{ $user->siswa->kelas->tingkat }} {{ $user->siswa->kelas->jurusan->nama_jurusan }} {{ $user->siswa->kelas->nama_kelas }}
                                        </p>
                                    </div>
                                </div>

                                {{-- Tahun Ajaran --}}
                                <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                    <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class='bx bx-calendar text-white text-2xl'></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm text-gray-600 mb-1">Tahun Ajaran</p>
                                        <p class="text-lg font-semibold text-gray-900">{{ $user->siswa->kelas->tahun_ajaran }}</p>
                                    </div>
                                </div>

                            </div>

                            {{-- Info Box --}}
                            <div class="mt-6 md:mt-8 bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4 md:p-6">
                                <div class="flex gap-3 md:gap-4">
                                    <i class='bx bx-info-circle text-2xl md:text-3xl text-blue-500 flex-shrink-0'></i>
                                    <div>
                                        <h3 class="font-bold text-[#0C356A] mb-2 text-sm md:text-base">Informasi Penting</h3>
                                        <p class="text-gray-700 text-xs md:text-sm leading-relaxed">
                                            Data profil kamu dikelola oleh admin sekolah. Jika ada kesalahan atau perlu pembaruan data, 
                                            silakan hubungi bagian tata usaha atau admin sekolah.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="mt-6 md:mt-8 flex flex-col sm:flex-row gap-3 md:gap-4">
                                <a href="{{ route('siswa.dashboard') }}" 
                                   class="flex-1 bg-[#0C356A] text-white px-6 py-3 rounded-lg md:rounded-xl font-bold hover:bg-[#ffc436] hover:text-[#0C356A] transition text-center text-sm md:text-base">
                                    <i class='bx bx-home'></i> Kembali ke Dashboard
                                </a>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </main>
        
    </div>
</div>

{{-- Alpine Store for Sidebar State --}}
<script>
document.addEventListener('alpine:init', () => {
    Alpine.store('sidebar', {
        isOpen: window.innerWidth >= 1024,
        
        toggle() {
            this.isOpen = !this.isOpen;
        },
        
        close() {
            if (window.innerWidth < 1024) {
                this.isOpen = false;
            }
        },
        
        open() {
            this.isOpen = true;
        }
    });
    
    // Handle window resize
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) {
            Alpine.store('sidebar').isOpen = true;
        }
    });
});
</script>