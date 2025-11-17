<div class="flex min-h-screen">
    <style>
        .table-row:hover {
            background-color: #f8fafc;
        }
    </style>

    <x-sidebar />

    <div class="w-full mx-10 mt-10 bg-white rounded-2xl shadow-md overflow-hidden">

        {{-- Header --}}
        <div class="bg-[#0C356A] text-white p-7 flex justify-between items-center">
            <h2 class="text-2xl font-bold flex items-center gap-2">
                Daftar Artikel
            </h2>

            <a href="{{ route('create-artikel') }}"
                class="bg-[#FFC436] text-[#0C356A] font-semibold px-4 py-2 rounded-lg hover:bg-yellow-400 transition">
                + Tambah Artikel
            </a>
        </div>

        {{-- Success Message --}}
        @if (session()->has('message'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-800 px-6 py-4 flex items-center gap-3">
                <i class='bx bx-check-circle text-2xl'></i>
                <span class="font-medium">{{ session('message') }}</span>
            </div>
        @endif

        {{-- Empty State --}}
        @if($data->isEmpty())
            <div class="text-center py-16 px-6">
                <i class='bx bx-news text-6xl text-gray-300 mb-4'></i>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Artikel</h3>
                <p class="text-gray-500 mb-6">Mulai tambahkan artikel terbaru untuk sekolah</p>
                <a href="{{ route('create-artikel') }}"
                   class="inline-flex items-center gap-2 bg-[#FFC436] text-[#0C356A] font-semibold px-6 py-2.5 rounded-lg hover:bg-yellow-400">
                    <i class='bx bx-plus text-xl'></i>
                    Tambah Artikel
                </a>
            </div>

        @else
            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-100 border-b-2 border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Judul</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Deskripsi</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Thumbnail</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @foreach ($data as $item)
                            <tr class="table-row">

                                <td class="px-6 py-4">
                                    <span class="text-sm font-medium text-gray-900">{{ $loop->iteration }}</span>
                                </td>

                                <td class="px-6 py-4">
                                    <span class="text-sm font-medium text-gray-900">{{ $item->judul }}</span>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <span class="text-sm capitalize font-medium 
                                        {{ $item->status === 'publish' ? 'text-green-600' : 'text-gray-500' }}">
                                        {{ $item->status }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <span class="text-sm text-gray-800">{{ $item->deskripsi }}</span>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    @if ($item->thumbnail)
                                        <div class="flex justify-center">
                                            <a href="{{ asset('storage/' . $item->thumbnail) }}" target="_blank">
                                                <img src="{{ asset('storage/' . $item->thumbnail) }}"
                                                     class="h-16 w-24 object-cover rounded-lg border-2 border-gray-200 hover:border-[#FFC436] transition cursor-pointer">
                                            </a>
                                        </div>
                                    @else
                                        <span class="text-sm text-gray-400">-</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('detail-artikel', $item->id) }}"
                                           class="bg-yellow-500 text-white px-3 py-1.5 rounded-lg hover:bg-yellow-600 text-sm font-medium inline-flex items-center gap-1 transition">
                                            <i class='bx bx-eye'></i>
                                            Detail
                                        </a>
                                        <a href="{{ route('edit-artikel', $item->id) }}"
                                           class="bg-blue-500 text-white px-3 py-1.5 rounded-lg hover:bg-blue-600 text-sm font-medium inline-flex items-center gap-1">
                                            <i class='bx bx-edit'></i>
                                            Edit
                                        </a>
                                        <button 
                                            wire:click="confirmDelete({{ $item->id }})"
                                            class="bg-red-500 text-white px-3 py-1.5 rounded-lg hover:bg-red-600 text-sm font-medium inline-flex items-center gap-1">
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

        {{-- Modal Confirm Delete --}}
        @if ($artikelId)
            <div class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
                <div class="bg-white p-6 rounded-lg shadow-lg w-80">
                    <h2 class="text-lg font-semibold mb-4">Hapus Artikel?</h2>
                    <p class="mb-4 text-sm">Apakah kamu yakin ingin menghapus artikel ini?</p>

                    <div class="flex justify-end gap-2">
                        <button wire:click="$set('artikelId', null)"
                                class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                            Batal
                        </button>

                        <button wire:click="delete"
                                class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>
