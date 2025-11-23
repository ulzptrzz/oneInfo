<div class="flex min-h-screen">

    <aside class="fixed overflow-y-auto">
        <x-sidebar active="program" />
    </aside>

    {{-- KONTEN UTAMA --}}
    <div class="flex-1 ml-64 mr-20 min-h-screen">
        <div class="w-full mx-8 my-7 bg-white rounded-2xl shadow-md overflow-hidden">

            {{-- HEADER --}}
            <div class="bg-[#0C356A] text-white p-7 flex justify-between ">
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
                                <tr class=" hover:shadow-sm transition">

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
                        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                            <div class="bg-white rounded-lg shadow-xl p-6 max-w-sm w-full">
                                <div class="flex justify-center mb-4">
                                    <svg width="90px" height="90px" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M10 10V13M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6M10 21H9C7.34315 21 6 19.6569 6 18V6M18 6V9M14 10V10.5M17 15.5V17H18.5M21 17C21 19.2091 19.2091 21 17 21C14.7909 21 13 19.2091 13 17C13 14.7909 14.7909 13 17 13C19.2091 13 21 14.7909 21 17Z"
                                            stroke="#0C356A" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <h3 class="text-lg text-center font-semibold mb-1 text-[#0C356A]">Hapus prestasi?</h3>
                                <p class="text-sm text-center text-gray-600 mb-6">
                                    Apakah anda yakin ingin menghapus prestasi ini?
                                </p>

                                <div class="flex justify-end gap-3">
                                    <button wire:click="cancelDelete"
                                        class="px-3 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                                        Batal
                                    </button>
                                    <button wire:click="hapus" wire:loading.attr="disabled"
                                        class="px-3 py-2 bg-red-600 text-white rounded hover:bg-red-700 disabled:opacity-50">
                                        <span wire:loading.remove>Hapus</span>
                                        <span wire:loading>Hapus...</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
