<div class="flex min-h-screen">

    <aside class="fixed overflow-y-auto">
        <x-sidebar active="program" />
    </aside>

    {{-- KONTEN UTAMA --}}
    <div class="flex-1 ml-64 mr-20 min-h-screen">
        <div class="w-full mx-8 my-7 overflow-hidden">
            {{-- Welcome Section --}}
            <div class="mb-10">
                <div class="bg-gradient-to-r from-[#0C356A] to-[#1e40af] rounded-2xl shadow-xl p-8 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-4xl font-bold mb-2">Selamat Datang, Admin!</h1>
                            <p class="text-blue-100 text-lg">Di Dashboard OneInfo.id</p>
                            <p class="text-blue-200 text-sm mt-1">Kelola semua konten dan informasi sekolah dengan mudah
                            </p>
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
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
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
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center">
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
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl flex items-center justify-center">
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
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center">
                            <i class='bx bx-news text-3xl text-white'></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid lg:grid-cols-2 gap-8">
                <!-- Recent Activity -->
                <div class="bg-white rounded-2xl shadow-lg p-7 flex flex-col">
                    <h3 class="text-2xl font-bold text-[#0C356A] mb-6 flex items-center gap-3">
                        <i class='bx bx-history text-[#FFC436]'></i>
                        Aktivitas Terbaru
                    </h3>
                    <div class="flex-1 overflow-y-auto max-h-96 pr-2"> 
                        <div class="space-y-5">
                            @forelse($activities as $activity)
                                <div
                                    class="flex items-start gap-4 pb-4 border-b border-gray-100 last:border-0 last:pb-0">
                                    <div
                                        class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0
                                        {{ $activity['color'] === 'blue' ? 'bg-blue-100' : '' }}
                                        {{ $activity['color'] === 'green' ? 'bg-green-100' : '' }}
                                        {{ $activity['color'] === 'yellow' ? 'bg-yellow-100' : '' }}
                                        {{ $activity['color'] === 'purple' ? 'bg-purple-100' : '' }}">
                                        <i
                                            class='bx {{ $activity['icon'] }} text-2xl
                                            {{ $activity['color'] === 'blue' ? 'text-blue-600' : '' }}
                                            {{ $activity['color'] === 'green' ? 'text-green-600' : '' }}
                                            {{ $activity['color'] === 'yellow' ? 'text-yellow-600' : '' }}
                                            {{ $activity['color'] === 'purple' ? 'text-purple-600' : '' }}'>
                                        </i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-semibold text-gray-800 text-sm">{{ $activity['title'] }}</p>
                                        <p class="text-gray-600 text-sm mt-0.5">{{ $activity['description'] }}</p>
                                        <p class="text-xs text-gray-500 mt-1">{{ $activity['time'] }}</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center text-gray-500 py-12">Belum ada aktivitas terbaru</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Quick Actions → TETAP DI TEMPAT, TIDAK IKUT TURUN -->
                <div class="bg-white rounded-2xl shadow-lg p-7">
                    <h3 class="text-2xl font-bold text-[#0C356A] mb-6 flex items-center gap-3">
                        <i class='bx bx-bolt-circle text-[#FFC436]'></i>
                        Quick Actions
                    </h3>
                    <div class="grid grid-cols-2 gap-4">
                        <a href="{{ route('create-program') }}"
                            class="group p-6 bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl hover:shadow-xl transition-all duration-300 text-center hover:scale-105">
                            <i class='bx bx-receipt text-4xl text-blue-600 mb-3 group-hover:animate-pulse'></i>
                            <p class="font-bold text-blue-900">Tambah Program</p>
                        </a>
                        <a href="{{ route('create-dokumentasi') }}"
                            class="group p-6 bg-gradient-to-br from-green-50 to-green-100 rounded-2xl hover:shadow-xl transition-all duration-300 text-center hover:scale-105">
                            <i class='bx bx-camera text-4xl text-green-600 mb-3 group-hover:animate-pulse'></i>
                            <p class="font-bold text-green-900">Tambah Dokumentasi</p>
                        </a>
                        <a href="{{ route('create-prestasi') }}"
                            class="group p-6 bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-2xl hover:shadow-xl transition-all duration-300 text-center hover:scale-105">
                            <i class='bx bx-medal text-4xl text-yellow-600 mb-3 group-hover:animate-pulse'></i>
                            <p class="font-bold text-yellow-900">Tambah Prestasi</p>
                        </a>
                        <a href="{{ route('create-artikel') }}"
                            class="group p-6 bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl hover:shadow-xl transition-all duration-300 text-center hover:scale-105">
                            <i class='bx bx-news text-4xl text-purple-600 mb-3 group-hover:animate-pulse'></i>
                            <p class="font-bold text-purple-900">Tambah Artikel</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-whatsapp/>
</div>
