<div class="flex min-h-screen">

    <aside class="fixed overflow-y-auto">
        <x-sidebar-siswa />
    </aside>

    {{-- KONTEN UTAMA --}}
    <div class="flex-1 ml-64 mr-20 min-h-screen">
        <div class="w-full mx-8 my-7">

            {{-- Header Welcome --}}
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-[#0C356A] mb-2">
                    Selamat datang, {{ $siswa->name }}!
                </h1>
                <p class="text-gray-600">Ringkasan aktivitas dan program untuk kamu</p>
            </div>

            {{-- Statistik Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

                {{-- Prestasi --}}
                <div
                    class="bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition-all hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                            <i class='bx bx-trophy text-3xl'></i>
                        </div>
                        <span class="text-4xl font-bold">{{ $prestasi }}</span>
                    </div>
                    <h3 class="text-lg font-semibold mb-1">Prestasi</h3>
                    <p class="text-yellow-100 text-sm">Total prestasi yang kamu raih</p>
                </div>

                {{-- Pendaftaran --}}
                <div
                    class="bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition-all hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                            <i class='bx bx-book text-3xl'></i>
                        </div>
                        <span class="text-4xl font-bold">{{ $pendaftaran }}</span>
                    </div>
                    <h3 class="text-lg font-semibold mb-1">Pendaftaran</h3>
                    <p class="text-blue-100 text-sm">Program yang kamu daftar</p>
                </div>

                {{-- Favorit --}}
                <div
                    class="bg-gradient-to-br from-purple-500 to-purple-700 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition-all hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                            <i class='bx bx-bookmark text-3xl'></i>
                        </div>
                        <span class="text-4xl font-bold">{{ $favorit }}</span>
                    </div>
                    <h3 class="text-lg font-semibold mb-1">Program Favorit</h3>
                    <p class="text-purple-100 text-sm">Program yang kamu simpan</p>
                </div>

            </div>

            {{-- Rekomendasi & Deadline --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                {{-- Rekomendasi Program --}}
                <div class="bg-white shadow-lg rounded-2xl p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="font-bold text-[#0C356A] text-2xl flex items-center gap-2">
                            <i class='bx bx-star text-[#ffc436] text-3xl'></i>
                            Rekomendasi Program
                        </h2>
                        <a href="{{ route('siswa.list-pendaftaran') }}"
                            class="text-[#0C356A] hover:text-[#ffc436] font-semibold text-sm transition">
                            Lihat Semua →
                        </a>
                    </div>

                    @forelse ($rekomendasi as $item)
                        <div
                            class="p-4 border border-gray-200 rounded-xl mb-3 hover:border-[#0C356A] hover:shadow-md transition-all group">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-bold text-[#0C356A] group-hover:text-[#ffc436] transition flex-1">
                                    {{ $item['nama'] }}
                                </h3>
                                <span
                                    class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold ml-2">
                                    Baru
                                </span>
                            </div>
                            <div class="flex items-center gap-4 text-sm text-gray-600">
                                <span class="flex items-center gap-1">
                                    <i class='bx bx-category'></i>
                                    {{ $item['kategori'] }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <i class='bx bx-trophy'></i>
                                    {{ $item['tingkat'] }}
                                </span>
                            </div>
                            @if ($item['penyelenggara'] && $item['penyelenggara'] != '-')
                                <p class="text-xs text-gray-500 mt-2">
                                    <i class='bx bx-building'></i> {{ $item['penyelenggara'] }}
                                </p>
                            @endif
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <i class='bx bx-book text-6xl text-gray-300 mb-3'></i>
                            <p class="text-gray-500 font-medium">Belum ada rekomendasi program</p>
                            <p class="text-gray-400 text-sm mt-1">Program baru akan muncul di sini</p>
                        </div>
                    @endforelse
                </div>

                {{-- Deadline Terdekat --}}
                <div class="bg-white shadow-lg rounded-2xl p-6">
                    <h2 class="font-bold text-[#0C356A] text-2xl mb-6 flex items-center gap-2">
                        <i class='bx bx-alarm text-red-500 text-3xl'></i>
                        Deadline Terdekat
                    </h2>

                    @forelse ($deadline as $d)
                        <div
                            class="p-4 border border-gray-200 rounded-xl mb-3 hover:border-[#0C356A] hover:shadow-md transition-all">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-bold text-[#0C356A] flex-1">
                                    {{ $d['nama'] }}
                                </h3>

                                {{-- Status Badge --}}
                                @if ($d['status'] == 'urgent')
                                    <span
                                        class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold animate-pulse ml-2">
                                        <i class='bx bx-error-circle'></i>
                                        {{ $d['days_left'] }} hari!
                                    </span>
                                @elseif($d['status'] == 'warning')
                                    <span
                                        class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-xs font-semibold ml-2">
                                        <i class='bx bx-time'></i>
                                        {{ $d['days_left'] }} hari
                                    </span>
                                @elseif($d['status'] == 'expired')
                                    <span
                                        class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-semibold ml-2">
                                        <i class='bx bx-x-circle'></i>
                                        Berakhir
                                    </span>
                                @else
                                    <span
                                        class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold ml-2">
                                        <i class='bx bx-check-circle'></i>
                                        Tersedia
                                    </span>
                                @endif
                            </div>

                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <i class='bx bx-calendar'></i>
                                <span>Tenggat: {{ $d['tanggal'] }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <i class='bx bx-calendar-x text-6xl text-gray-300 mb-3'></i>
                            <p class="text-gray-500 font-medium">Tidak ada deadline</p>
                            <p class="text-gray-400 text-sm mt-1">Deadline program akan muncul di sini</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
