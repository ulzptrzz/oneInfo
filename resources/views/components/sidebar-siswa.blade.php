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