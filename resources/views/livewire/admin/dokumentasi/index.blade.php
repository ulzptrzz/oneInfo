<div class="flex min-h-screen">

    <aside class="fixed overflow-y-auto">
        <x-sidebar />
    </aside>

    {{-- KONTEN UTAMA --}}
    <div class="flex-1 ml-64 mr-20 min-h-screen">
        <div class="w-full mx-8 my-7 bg-white rounded-2xl shadow-md overflow-hidden">
            <div class="bg-[#0C356A] text-white p-7 flex justify-between items-center">
                <h2 class="text-2xl font-bold flex items-center gap-2">Daftar Dokumentasi</h2>
                <a href="{{ route('create-dokumentasi') }}"
                    class="bg-[#ffc436] text-[#0C356A] font-semibold px-4 py-2 rounded-lg hover:bg-yellow-400 transition">
                    + Tambah Dokumentasi
                </a>
            </div>

            {{-- Success Message --}}
            @if (session()->has('message'))
                <div class="bg-green-50 border-l-4 border-green-500 text-green-800 px-6 py-4 flex items-center gap-3">
                    <i class='bx bx-check-circle text-2xl'></i>
                    <span class="font-medium">{{ session('message') }}</span>
                </div>
            @endif

            {{-- Content --}}
            @if ($dokumentasi->isEmpty())
                {{-- Empty State --}}
                <div class="text-center py-16 px-6">
                    <i class='bx bx-camera text-6xl text-gray-300 mb-4'></i>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Dokumentasi</h3>
                    <p class="text-gray-500 mb-6">Mulai tambahkan dokumentasi kegiatan sekolah</p>
                    <a href="{{ route('create-dokumentasi') }}"
                        class="inline-flex items-center gap-2 bg-[#FFC436] text-[#0C356A] font-semibold px-6 py-2.5 rounded-lg hover:bg-yellow-400">
                        <i class='bx bx-plus text-xl'></i>
                        Tambah Dokumentasi
                    </a>
                </div>
            @else
                {{-- Table --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-gray-100 border-b-2 border-gray-200">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    No
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Judul
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Prestasi
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Foto
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Video
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($dokumentasi as $index => $item)
                                @php
                                    // Decode foto JSON
                                    $fotoArray = is_string($item->foto) 
                                        ? json_decode($item->foto, true) ?? [] 
                                        : $item->foto ?? [];
                                    $firstPhoto = !empty($fotoArray) ? $fotoArray[0] : null;
                                @endphp
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm font-medium text-gray-900">{{ $loop->iteration }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-semibold text-gray-900">{{ $item->judul }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-sm font-medium text-gray-900">
                                            {{ $item->prestasi->id ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if (!empty($fotoArray) && count($fotoArray) > 0)
                                            <div class="flex justify-center mt-1">
                                                <img src="{{ asset('storage/' . $firstPhoto) }}" 
                                                    alt="Foto preview"
                                                    class="h-16 w-24 object-cover rounded-lg border-2 border-gray-200 hover:border-[#FFC436] transition cursor-pointer shadow-sm">
                                            </div>
                                            <span class="text-xs text-gray-500 mt-0.5">
                                                <i class='bx bx-images'></i>
                                                {{ count($fotoArray) }} foto
                                            </span>


                                        @else
                                            <span class="text-sm text-gray-400 flex items-center justify-center gap-1">
                                                <i class='bx bx-image-alt'></i>
                                                Tidak ada
                                            </span>
                                        @endif

                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        @if ($item->video)
                                            <a href="{{ $item->video }}" target="_blank"
                                                class="inline-flex items-center gap-1 text-sm text-blue-600 hover:text-blue-800 font-medium transition">
                                                <i class='bx bx-link-external'></i>
                                                Lihat Video
                                            </a>
                                        @else
                                            <span class="text-sm text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('detail-dokumentasi', $item->id) }}"
                                                class="bg-yellow-500 text-white px-3 py-1.5 rounded-lg hover:bg-yellow-600 text-sm font-medium inline-flex items-center gap-1 transition">
                                                <i class='bx bx-eye'></i>
                                                Detail
                                            </a>
                                            <a href="{{ route('edit-dokumentasi', $item->id) }}"
                                                class="bg-blue-500 text-white px-3 py-1.5 rounded-lg hover:bg-blue-600 text-sm font-medium inline-flex items-center gap-1 transition">
                                                <i class='bx bx-edit'></i>
                                                Edit
                                            </a>
                                            <button wire:click="confirmDelete({{ $item->id }})"
                                                class="bg-red-500 text-white px-3 py-1.5 rounded-lg hover:bg-red-600 text-sm font-medium inline-flex items-center gap-1 transition">
                                                <i class='bx bx-trash'></i>
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    {{-- Modal Delete Confirmation --}}
    @if ($showDeleteModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-2xl shadow-2xl p-6 max-w-md w-full transform transition-all">
                <div class="flex justify-center mb-4">
                    <div class="bg-red-100 rounded-full p-4">
                        <svg class="w-16 h-16 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-xl text-center font-bold mb-2 text-gray-800">
                    Hapus Dokumentasi?
                </h3>
                <p class="text-sm text-center text-gray-600 mb-6">
                    Data dokumentasi dan semua foto yang terkait akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan.
                </p>

                <div class="flex gap-3">
                    <button wire:click="cancelDelete"
                        class="flex-1 px-4 py-2.5 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition">
                        Batal
                    </button>
                    <button wire:click="hapus" wire:loading.attr="disabled"
                        class="flex-1 px-4 py-2.5 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition disabled:opacity-50 disabled:cursor-not-allowed">
                        <span wire:loading.remove wire:target="hapus">Hapus</span>
                        <span wire:loading wire:target="hapus">
                            <i class='bx bx-loader-alt animate-spin'></i>
                            Menghapus...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>  