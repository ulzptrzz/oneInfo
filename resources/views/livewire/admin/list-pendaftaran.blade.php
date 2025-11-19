<div>
    <div class="flex min-h-screen">
        <x-sidebar />
        <div class="w-full mx-8 my-7 bg-white rounded-2xl shadow-md overflow-hidden">
            <div class="p-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-8">Pendaftaran Program</h1>

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
                                    <td colspan="6" class="text-center py-10 text-gray-500">
                                        <div class="col-span-1 md:col-span-2 lg:col-span-3">
                                            <div class="flex flex-col items-center justify-center text-center">
                                                <svg width="120px" height="120px" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg" class="mb-3">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M9.29289 1.29289C9.48043 1.10536 9.73478 1 10 1H18C19.6569 1 21 2.34315 21 4V7C21 7.55228 20.5523 8 20 8C19.4477 8 19 7.55228 19 7V4C19 3.44772 18.5523 3 18 3H11V8C11 8.55228 10.5523 9 10 9H5V20C5 20.5523 5.44772 21 6 21H11C11.5523 21 12 21.4477 12 22C12 22.5523 11.5523 23 11 23H6C4.34315 23 3 21.6569 3 20V8C3 7.73478 3.10536 7.48043 3.29289 7.29289L9.29289 1.29289ZM6.41421 7H9V4.41421L6.41421 7ZM18.25 20.75C18.25 21.4404 17.6904 22 17 22C16.3096 22 15.75 21.4404 15.75 20.75C15.75 20.0596 16.3096 19.5 17 19.5C17.6904 19.5 18.25 20.0596 18.25 20.75ZM15.1353 12.9643C15.3999 12.4596 16.0831 12 17 12C18.283 12 19 12.8345 19 13.5C19 14.1655 18.283 15 17 15C16.4477 15 16 15.4477 16 16V17C16 17.5523 16.4477 18 17 18C17.5523 18 18 17.5523 18 17V16.8866C19.6316 16.5135 21 15.2471 21 13.5C21 11.404 19.0307 10 17 10C15.4566 10 14.0252 10.7745 13.364 12.0357C13.1075 12.5248 13.2962 13.1292 13.7853 13.3857C14.2744 13.6421 14.8788 13.4535 15.1353 12.9643Z"
                                                        fill="#0C356A" />
                                                </svg>
                                                <p class="text-[#0C356A] font-semibold">Belum ada pendaftaran</p>
                                            </div>
                                        </div>
                                        {{ $statusFilter !== 'all' ? $statusFilter : '' }}
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
