<div>
    <div class="flex min-h-screen">
        <x-sidebar />
        <div>
            <div class="p-6 bg-gray-50 min-h-screen">
                <h1 class="text-3xl font-bold text-gray-800 mb-8">Manajemen Pendaftaran Program</h1>

                @if (session('success'))
                    <div
                        class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg mb-6 flex items-center gap-3">
                        <i class="bx bx-check-circle text-2xl"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div
                        class="bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-lg mb-6 flex items-center gap-3">
                        <i class="bx bx-x-circle text-2xl"></i>
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Filter & Search -->
                <div class="bg-white rounded-xl shadow-md p-5 mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="text" wire:model.debounce.500ms="search"
                            placeholder="Cari nama siswa / program..."
                            class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#0C356A] focus:outline-none">

                        <select wire:model.live="statusFilter"
                            class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#0C356A] focus:outline-none">
                            <option value="all">Semua Status</option>
                            <option value="pending">Pending</option>
                            <option value="approved">Disetujui</option>
                            <option value="rejected">Ditolak</option>
                        </select>
                    </div>
                </div>

                <!-- Tabel -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <table class="w-full table-auto">
                        <thead class="bg-[#0C356A] text-white">
                            <tr>
                                <th class="px-6 py-4 text-left">No</th>
                                <th class="px-6 py-4 text-left">Siswa</th>
                                <th class="px-6 py-4 text-left">Program</th>
                                <th class="px-6 py-4 text-left">Tanggal Daftar</th>
                                <th class="px-6 py-4 text-center">Status</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($pendaftarans as $i => $p)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">{{ $pendaftarans->firstItem() + $i }}</td>
                                    <td class="px-6 py-4">
                                        <div class="font-medium">{{ $p->siswa->user->name }}</div>
                                        <small class="text-gray-500">{{ $p->siswa->nis }}</small>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-medium">{{ $p->program->name }}</div>
                                        <small class="text-gray-500">{{ $p->program->penyelenggara }}</small>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ \Carbon\Carbon::parse($p->tanggal_daftar)->translatedFormat('d F Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if ($p->status === 'pending')
                                            <span
                                                class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm">Menunggu</span>
                                        @elseif($p->status === 'approved')
                                            <span
                                                class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">Disetujui</span>
                                        @else
                                            <span
                                                class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">Ditolak</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if ($p->status === 'pending')
                                            <div class="flex justify-center gap-3">
                                                <button wire:click="updateStatus({{ $p->id }}, 'approve')"
                                                    class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg text-sm transition">
                                                    Setujui
                                                </button>
                                                <button wire:click="updateStatus({{ $p->id }}, 'reject')"
                                                    class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg text-sm transition">
                                                    Tolak
                                                </button>
                                            </div>
                                        @else
                                            <span class="text-gray-400 text-sm">Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-12 text-gray-500">
                                        Tidak ada pendaftaran {{ $statusFilter !== 'all' ? $statusFilter : '' }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="p-4 bg-gray-50">
                        {{ $pendaftarans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>