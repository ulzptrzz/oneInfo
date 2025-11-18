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
            
            <a href="{{ route('admin.dokumentasi') }}"
                class="flex items-center gap-3 px-4 py-2 rounded-lg font-medium transition duration-200 
                        hover:bg-[#FFC436] hover:text-[#0C356A] group">
                    <i class='bx bx-camera text-lg text-white group-hover:text-[#0C356A]'></i>
                    <span>Dokumentasi</span>
            </a>
            
            <a href="{{ route('admin.prestasi') }}"
                class="flex items-center gap-3 px-4 py-2 rounded-lg font-medium transition duration-200 
                        hover:bg-[#FFC436] hover:text-[#0C356A] group">
                    <i class='bx bx-medal text-lg text-white group-hover:text-[#0C356A]'></i>
                    <span>Prestasi</span>
            </a>
            
            <a href="{{ route('admin.artikel') }}"
                class="flex items-center gap-3 px-4 py-2 rounded-lg font-medium transition duration-200 
                        hover:bg-[#FFC436] hover:text-[#0C356A] group">
                    <i class='bx bx-news text-lg text-white group-hover:text-[#0C356A]'></i>
                    <span>Artikel</span>
            </a>
            <a href="{{ route('list-pendaftaran-program') }}"
                class="flex items-center gap-3 px-4 py-2 rounded-lg font-medium transition duration-200 
                        hover:bg-[#FFC436] hover:text-[#0C356A] group">
                    <i class='bx bx-file text-lg text-white group-hover:text-[#0C356A]'></i>
                    <span>Pendaftaran</span>
            </a>
            <a href="{{ route('admin.profil') }}"
                class="flex items-center gap-3 px-4 py-2 rounded-lg font-medium transition duration-200 
                        hover:bg-[#FFC436] hover:text-[#0C356A] group">
                    <i class='bx bx-user text-lg text-white group-hover:text-[#0C356A]'></i>
                    <span>Profile</span>
            </a>
        </nav>
    </div>
    <livewire:auth.logout />
    
</aside>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const menuItems = document.querySelectorAll("nav a");
        const currentPath = window.location.pathname;

        menuItems.forEach((item) => {
            item.style.transition = "none";
            item.style.outline = "none";
            item.style.transform = "none";

            const itemPath = new URL(item.href).pathname;

            // Cek apakah path halaman sekarang berada di dalam path menu
            // Contoh: /admin/dokumentasi/create cocok dengan /admin/dokumentasi
            if (currentPath.startsWith(itemPath)) {
                item.style.backgroundColor = "#FFC436";
                item.style.color = "#0C356A";
                item.querySelector("i").style.color = "#0C356A";
            }

            item.addEventListener("click", (e) => {
                e.preventDefault();

                menuItems.forEach((i) => {
                    i.style.backgroundColor = "";
                    i.style.color = "";
                    i.querySelector("i").style.color = "white";
                });

                item.style.backgroundColor = "#FFC436";
                item.style.color = "#0C356A";
                item.querySelector("i").style.color = "#0C356A";

                window.location.href = item.href;
            });
        });
    });
</script>

