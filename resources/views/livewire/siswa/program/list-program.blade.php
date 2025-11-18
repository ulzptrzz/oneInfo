<div>
    <div class="flex min-h-screen">
        <x-sidebar-siswa />
        <div>
            <div class="max-w-7xl mx-auto p-6">
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
                                <div class="flex justify-between items-start mb-3">
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

                                <p class="text-sm text-gray-600 mb-2">
                                    <i class="bx bx-building"></i> {{ $program->penyelenggara }}
                                </p>

                                <div class="flex items-center gap-2 text-xs text-gray-500 mb-4">
                                    <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded">
                                        {{ $program->kategoriProgram?->nama_kategori ?? 'Uncategorized' }}
                                    </span>
                                    <span class="bg-purple-100 text-purple-700 px-2 py-1 rounded">
                                        {{ $program->tingkat }}
                                    </span>
                                </div>

                                <div class="flex justify-between items-center">
                                    <small class="text-gray-500">
                                        Daftar:
                                        {{ \Carbon\Carbon::parse($p->tanggal_daftar)->translatedFormat('d F Y') }}
                                    </small>

                                    <a href="{{ route('detail-program', $program->id) }}"
                                        class="text-[#0C356A] hover:underline text-sm font-medium">
                                        Lihat Detail →
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
</div>