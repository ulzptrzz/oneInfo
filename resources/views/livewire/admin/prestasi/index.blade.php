<div class="flex min-h-screen">

    <style>
        .table-row:hover {
            background-color: #f1f5f9; /* hover lembut */
        }
    </style>

    <x-sidebar active="prestasi" />

    <div class="w-full mx-8 my-9 bg-white rounded-2xl shadow-lg overflow-hidden">

        {{-- HEADER --}}
        <div class="bg-gradient-to-r from-[#0C356A] to-[#1e40af] text-white p-7 flex justify-between items-center">
            <h2 class="text-2xl font-bold flex items-center gap-2">
                Daftar Prestasi
            </h2>

            <a href="{{ route('create-prestasi') }}"
                class="bg-[#FFC436] shadow-md text-[#0C356A] font-semibold px-5 py-2.5 rounded-lg 
                       hover:bg-yellow-400 transition-all">
                + Tambah Prestasi
            </a>
        </div>

        {{-- SUCCESS ALERT --}}
        @if (session()->has('message'))
            <div class="bg-green-100 border-l-4 border-green-600 text-green-800 px-6 py-4 flex items-center gap-3">
                <i class='bx bx-check-circle text-2xl'></i>
                <span class="font-semibold">{{ session('message') }}</span>
            </div>
        @endif

        {{-- EMPTY STATE --}}
        @if ($prestasi->isEmpty())
            <div class="text-center py-20 px-6">
                <i class='bx bx-medal text-7xl text-gray-300 mb-4'></i>
                <h3 class="text-2xl font-bold text-gray-700 mb-2">Belum Ada Prestasi</h3>
                <p class="text-gray-500 mb-6">Silakan tambahkan prestasi siswa terlebih dahulu.</p>

                <a href="{{ route('create-prestasi') }}"
                    class="inline-flex items-center gap-2 bg-[#FFC436] text-[#0C356A] font-semibold 
                           px-6 py-3 rounded-lg hover:bg-yellow-400 transition">
                    <i class='bx bx-plus text-xl'></i> Tambah Prestasi
                </a>
            </div>

        @else
            {{-- TABLE --}}
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-100 border-b-2 border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase">No</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase">Deskripsi</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase">Siswa</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase">Program</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @foreach ($prestasi as $item)
                            <tr class="table-row hover:shadow-sm transition">

                                <td class="px-6 py-4 text-sm font-semibold text-gray-900">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-800">
                                    {{ $item->deskripsi }}
                                </td>

                                <td class="px-6 py-4 text-sm text-center text-gray-800">
                                    {{ $item->siswa->name ?? '-' }}
                                </td>

                                <td class="px-6 py-4 text-sm text-center text-gray-800">
                                    {{ $item->program->name ?? '-' }}
                                </td>

                                {{-- ACTION --}}
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">

                                        <a href="{{ route('edit-prestasi', $item->id) }}"
                                            class="bg-blue-500 text-white px-3 py-1.5 rounded-lg hover:bg-blue-600 
                                                   text-sm shadow items-center gap-1 inline-flex">
                                            <i class='bx bx-edit'></i> Edit
                                        </a>

                                        <button wire:click="confirmDelete({{ $item->id }})"
                                            class="bg-red-500 text-white px-3 py-1.5 rounded-lg hover:bg-red-600 
                                                   text-sm shadow inline-flex items-center gap-1">
                                            <i class='bx bx-trash'></i> Hapus
                                        </button>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- DELETE MODAL --}}
                @if ($showDeleteModal)
                    <div class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                        <div class="bg-white rounded-xl shadow-xl p-6 max-w-sm w-full">
                            <div class="flex justify-center mb-4">
                                <i class='bx bx-error-circle text-6xl text-[#0C356A]'></i>
                            </div>

                            <h3 class="text-lg text-center font-bold text-[#0C356A] mb-1">Hapus Prestasi?</h3>
                            <p class="text-sm text-center text-gray-600 mb-6">
                                Apakah Anda yakin ingin menghapus prestasi ini?
                            </p>

                            <div class="flex justify-end gap-3">
                                <button wire:click="cancelDelete"
                                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                                    Batal
                                </button>

                                <button wire:click="hapus" wire:loading.attr="disabled"
                                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 disabled:opacity-50">
                                    <span wire:loading.remove>Hapus</span>
                                    <span wire:loading>Memproses...</span>
                                </button>
                            </div>

                        </div>
                    </div>
                @endif

            </div>
        @endif
    </div>
</div>
