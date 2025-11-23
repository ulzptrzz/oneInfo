<div class="flex min-h-screen">

    <aside class="fixed overflow-y-auto">
        <x-sidebar-siswa />
    </aside>

    {{-- KONTEN UTAMA --}}
    <div class="flex-1 ml-64 mr-20 min-h-screen">
        <div class="w-full mx-8 my-7">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Program yang Saya Ikuti</h1>
                <p class="text-gray-600 mt-2">Kelola dan pantau status pendaftaran programmu di sini.</p>
            </div>

            <!-- Filter & Search -->
            <div class="bg-white rounded-xl shadow-md p-5 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <input type="text" wire:model.live.debounce.500ms="search"
                            placeholder="Cari nama program atau penyelenggara..."
                            class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0C356A]">
                    </div>
                    <div>
                        <select wire:model.live="statusFilter"
                            class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0C356A]">
                            <option value="all">Semua Status</option>
                            <option value="pending">Menunggu Persetujuan</option>
                            <option value="approved">Disetujui</option>
                            <option value="rejected">Ditolak</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Daftar Program -->
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @forelse($pendaftarans as $p)
                    @php $program = $p->program; @endphp
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition">
                        <img src="{{ asset('storage/' . $program->poster) }}" alt="{{ $program->name }}"
                            class="w-full h-48 object-cover">

                        <div class="p-5">
                            <div class="flex justify-between items-start gap-4 mb-3">
                                <h3 class="text-lg font-bold text-gray-800 line-clamp-2">
                                    {{ $program->name }}
                                </h3>
                                <span
                                    class="text-xs font-medium px-2 py-1 rounded-full
                                        {{ $p->status === 'pending'
                                            ? 'bg-yellow-100 text-yellow-800'
                                            : ($p->status === 'approved'
                                                ? 'bg-green-100 text-green-800'
                                                : 'bg-red-100 text-red-800') }}">
                                    {{ $p->status === 'pending' ? 'Menunggu' : ($p->status === 'approved' ? 'Disetujui' : 'Ditolak') }}
                                </span>
                            </div>

                            <p class="text-sm text-gray-600 mb-2">
                                <i class="bx bx-calendar"></i>
                                {{ \Carbon\Carbon::parse($program->tanggal_mulai)->translatedFormat('d M Y') }}
                                - {{ \Carbon\Carbon::parse($program->tanggal_selesai)->translatedFormat('d M Y') }}
                            </p>

                            @if ($program->mata_lomba)
                                <div class="mb-4">
                                    <p class="text-sm font-semibold text-gray-700 mb-2">Mata Lomba</p>
                                    <div class="flex flex-wrap gap-1">
                                        @foreach (json_decode($program->mata_lomba, true) as $ml)
                                            <span
                                                class="inline-block px-3 py-1.5 text-xs font-medium text-amber-700 bg-amber-100 rounded-full border border-amber-200 whitespace-nowrap">
                                                {{ Str::limit($ml, 30) }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <p class="text-sm font-semibold text-gray-700 mb-2">Kategori Program</p>
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span
                                    class="inline-flex items-center justify-center px-3 py-1.5 text-xs font-bold  text-indigo-700 bg-indigo-100 rounded-lg border border-indigo-200 min-w-[82px]">
                                    {{ $program->kategoriProgram?->nama_kategori ?? 'Umum' }}
                                </span>
                                <span
                                    class="inline-flex items-center justify-center px-3 py-1.5 text-xs font-bold text-purple-700 bg-purple-100 rounded-lg border border-purple-200 min-w-[82px]">
                                    {{ $program->tingkat }}
                                </span>
                            </div>

                            <small class="text-gray-500">
                                Daftar:
                                {{ \Carbon\Carbon::parse($p->tanggal_daftar)->translatedFormat('d F Y') }}
                            </small>
                            <div class="pt-3 mt-auto">
                                <a href="{{ route('detail-program', $program->id) }}"
                                    class="inline-flex items-center justify-center gap-2 w-full px-6 py-3.5 bg-[#0C356A] text-white font-semibold rounded-xl hover:bg-[#0a2b55] transform hover:scale-105 transition-all duration-300 shadow-md hover:shadow-xl">
                                    <span>Lihat Detail</span>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16">
                        <p class="text-xl text-gray-600">Kamu belum mendaftar program apapun.</p>
                        <a href="{{ route('list-program') }}"
                            class="mt-4 inline-block bg-[#0C356A] text-white px-6 py-3 rounded-lg hover:bg-[#082d5b] transition">
                            Cari Program Menarik
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $pendaftarans->links() }}
            </div>
        </div>
    </div>
</div>