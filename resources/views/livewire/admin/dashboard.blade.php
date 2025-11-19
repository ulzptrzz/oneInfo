<div class="bg-gray-100 text-gray-800">
  <div class="flex min-h-screen">
    <!-- Sidebar -->
    <x-sidebar/>

    <!-- Content -->
    <main class="flex-1 p-8">
      {{-- Welcome Section --}}
      <div class="mb-8">
        <div class="bg-gradient-to-r from-[#0C356A] to-[#1e40af] rounded-2xl shadow-xl p-8 text-white">
          <div class="flex items-center justify-between">
            <div>
              <h1 class="text-4xl font-bold mb-2">Selamat Datang, Admin!</h1>
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
      </div>

      {{-- Statistics Cards --}}
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        {{-- Total Program --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-gray-600 text-sm font-medium mb-1">Total Program</p>
              <h3 class="text-3xl font-bold text-[#0C356A]">{{ $totalProgram ?? '0' }}</h3>
            </div>
            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
              <i class='bx bx-receipt text-3xl text-white'></i>
            </div>
          </div>
        </div>

        {{-- Total Dokumentasi --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-gray-600 text-sm font-medium mb-1">Dokumentasi</p>
              <h3 class="text-3xl font-bold text-[#0C356A]">{{ $totalDokumentasi ?? '0' }}</h3>
            </div>
            <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center">
              <i class='bx bx-camera text-3xl text-white'></i>
            </div>
          </div>
        </div>

        {{-- Total Prestasi --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-gray-600 text-sm font-medium mb-1">Prestasi Siswa</p>
              <h3 class="text-3xl font-bold text-[#0C356A]">{{ $totalPrestasi ?? '0' }}</h3>
            </div>
            <div class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl flex items-center justify-center">
              <i class='bx bx-medal text-3xl text-white'></i>
            </div>
          </div>
        </div>

        {{-- Total Artikel --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-gray-600 text-sm font-medium mb-1">Artikel</p>
              <h3 class="text-3xl font-bold text-[#0C356A]">{{ $totalArtikel ?? '0' }}</h3>
            </div>
            <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center">
              <i class='bx bx-news text-3xl text-white'></i>
            </div>
          </div>
        </div>
      </div>

      {{-- Quick Actions --}}
      <div class="grid md:grid-cols-2 gap-6 mb-8">
        {{-- Recent Activity --}}
        <div class="bg-white rounded-xl shadow-md p-6">
          <h3 class="text-xl font-bold text-[#0C356A] mb-4 flex items-center gap-2">
            Aktivitas Terbaru
          </h3>
          <div class="space-y-4">
            <div class="flex items-start gap-3 pb-3 border-b border-gray-100">
              <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                <i class='bx bx-plus text-blue-600'></i>
              </div>
              <div class="flex-1">
                <p class="text-sm font-medium text-gray-800">Program baru ditambahkan</p>
                <p class="text-xs text-gray-500">Workshop Teknologi - 2 jam yang lalu</p>
              </div>
            </div>
            <div class="flex items-start gap-3 pb-3 border-b border-gray-100">
              <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                <i class='bx bx-camera text-green-600'></i>
              </div>
              <div class="flex-1">
                <p class="text-sm font-medium text-gray-800">Dokumentasi diupdate</p>
                <p class="text-xs text-gray-500">TOEIC 2025 Webinar - 5 jam yang lalu</p>
              </div>
            </div>
            <div class="flex items-start gap-3">
              <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center flex-shrink-0">
                <i class='bx bx-trophy text-yellow-600'></i>
              </div>
              <div class="flex-1">
                <p class="text-sm font-medium text-gray-800">Prestasi baru tercatat</p>
                <p class="text-xs text-gray-500">Juara 1 Olimpiade - 1 hari yang lalu</p>
              </div>
            </div>
          </div>
        </div>

        {{-- Quick Links --}}
        <div class="bg-white rounded-xl shadow-md p-6">
          <h3 class="text-xl font-bold text-[#0C356A] mb-4 flex items-center gap-2">
            Quick Actions
          </h3>
          <div class="grid grid-cols-2 gap-3">
            <a href="{{ route('create-program') }}" class="p-4 bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg hover:shadow-md transition text-center">
              <i class='bx bx-receipt text-3xl text-blue-600 mb-2'></i>
              <p class="text-sm font-semibold text-blue-900">Tambah Program</p>
            </a>
            <a href="{{ route('create-dokumentasi') }}" class="p-4 bg-gradient-to-br from-green-50 to-green-100 rounded-lg hover:shadow-md transition text-center">
              <i class='bx bx-camera text-3xl text-green-600 mb-2'></i>
              <p class="text-sm font-semibold text-green-900">Tambah Dokumentasi</p>
            </a>
            <a href="{{ route('create-prestasi') }}" class="p-4 bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-lg hover:shadow-md transition text-center">
              <i class='bx bx-medal text-3xl text-yellow-600 mb-2'></i>
              <p class="text-sm font-semibold text-yellow-900">Tambah Prestasi</p>
            </a>
            <a href="{{ route('create-artikel') }}" class="p-4 bg-gradient-to-br from-purple-50 to-purple-100 rounded-lg hover:shadow-md transition text-center">
              <i class='bx bx-news text-3xl text-purple-600 mb-2'></i>
              <p class="text-sm font-semibold text-purple-900">Tambah Artikel</p>
            </a>
          </div>
        </div>
      </div>
    </main>
    <x-whatsapp />
  </div>
  @livewireScripts
</div>