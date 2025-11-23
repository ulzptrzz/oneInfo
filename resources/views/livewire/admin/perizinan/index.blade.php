<div class="flex min-h-screen bg-gray-50">

    {{-- SIDEBAR FIXED --}}
    <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-[#0C356A] shadow-xl overflow-y-auto">
        <x-sidebar active="program" />
    </aside>

    {{-- KONTEN UTAMA --}}
    <div class="flex-1 ml-64 min-h-screen">

        <div class="max-w-7xl mx-auto px-6 py-8 lg:px-10">

            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

                {{-- Header --}}
                <div class="bg-[#0C356A] text-white p-6 lg:p-8">
                    <h1 class="text-2xl lg:text-3xl font-bold">Daftar Perizinan Siswa</h1>
                    <p class="text-blue-100 text-sm mt-1">Kelola semua surat izin program dan lomba</p>
                </div>

                {{-- Search Bar --}}
                <div class="p-6 border-b border-gray-200">
                    <div class="relative max-w-md">
                        <i class='bx bx-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 text-xl'></i>
                        <input 
                            wire:model.debounce.500ms="search" 
                            type="text" 
                            placeholder="Cari nama siswa..."
                            class="w-full pl-12 pr-5 py-4 border-2 border-gray-300 rounded-xl focus:border-[#FFC436] focus:outline-none transition text-gray-800 font-medium">
                    </div>
                </div>

                {{-- Tabel --}}
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-[#0C356A] text-white">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">No</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Siswa</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Program</th>
                                <th class="px-6 py-4 text-center text-sm font-semibold uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-center text-sm font-semibold uppercase tracking-wider">Surat Izin</th>
                                {{-- <th class="px-6 py-4 text-center text-sm font-semibold uppercase tracking-wider">Aksi</th> --}}
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($perizinans as $i => $p)
                                @php
                                    $statusColor = match($p->status) {
                                        'pending'   => 'bg-yellow-100 text-yellow-800',
                                        'approved'  => 'bg-green-100 text-green-800',
                                        'rejected'  => 'bg-red-100 text-red-800',
                                        default     => 'bg-gray-100 text-gray-800',
                                    };
                                @endphp
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-sm text-gray-700 font-medium">
                                        {{ $perizinans->firstItem() + $i }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-gradient-to-br from-[#FFC436] to-yellow-500 rounded-full flex items-center justify-center text-[#0C356A] font-bold text-sm">
                                                {{ Str::substr($p->pendaftaran->siswa->user->name, 0, 2) }}
                                            </div>
                                            <div>
                                                <p class="font-semibold text-gray-900">
                                                    {{ $p->pendaftaran->siswa->user->name }}
                                                </p>
                                                <p class="text-xs text-gray-500">
                                                    {{ $p->pendaftaran->siswa->kelas->display_name ?? 'Kelas tidak diketahui' }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-800 font-medium">
                                        {{ Str::limit($p->pendaftaran->program->name, 50) }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold {{ $statusColor }}">
                                            {{ ucfirst($p->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if($p->surat_path)
                                            <a href="{{ asset('storage/' . $p->surat_path) }}" 
                                               target="_blank"
                                               class="inline-flex items-center gap-1 text-green-600 hover:text-green-800 font-medium text-sm">
                                                <i class='bx bx-download'></i> Unduh
                                            </a>
                                        @else
                                            <span class="text-gray-400 text-sm">Belum upload</span>
                                        @endif
                                    </td>
                                    {{-- <td class="px-6 py-4 text-center">
                                        <a href="{{ route('admin.perizinan.view', $p->id) }}"
                                           class="inline-flex items-center gap-2 bg-[#FFC436] text-[#0C356A] px-4 py-2 rounded-lg hover:bg-yellow-400 transition font-semibold text-sm shadow-sm">
                                            <i class='bx bx-show'></i> Detail
                                        </a>
                                    </td> --}}
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-16 text-gray-500">
                                        <i class='bx bx-file-blank text-6xl mb-4 text-gray-300'></i>
                                        <p class="font-medium">Belum ada perizinan</p>
                                        <p class="text-sm">Surat izin akan muncul di sini ketika siswa mengajukan</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="bg-gray-50 border-t border-gray-200 px-6 py-4">
                    {{ $perizinans->onEachSide(1)->links() }}
                </div>

            </div>
        </div>
    </div>
</div>