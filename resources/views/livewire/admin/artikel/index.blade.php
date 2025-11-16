<div class="flex min-h-screen">
    <x-sidebar />

    <div class="w-full mx-10 mt-10 bg-white rounded-2xl shadow-md overflow-hidden">

        {{-- Header --}}
        <div class="bg-[#0C356A] text-white p-7 flex justify-between items-center">
            <h2 class="text-2xl font-bold flex items-center gap-2">
                <i class='bx bx-news text-2xl'></i>
                Daftar Artikel
            </h2>

            <a href="{{ route('create-artikel') }}"
                class="bg-[#FFC436] text-white font-semibold px-4 py-2 rounded-lg hover:bg-yellow-900 transition">
                + Tambah Artikel
            </a>
        </div>

        {{-- Alert --}}
        @if (session()->has('message'))
            <div class="bg-green-100 text-green-800 px-3 py-2 rounded m-4">
                {{ session('message') }}
            </div>
        @endif

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full text-gray-700 m-4">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="border p-2">No</th>
                        <th class="border p-2">Judul</th>
                        <th class="border p-2">Status</th>
                        <th class="border p-2">Tanggal</th>
                        <th class="border p-2">Thumbnail</th>
                        <th class="border p-2">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td class="border p-2 text-center">{{ $loop->iteration }}</td>
                            <td class="border p-2 text-center">{{ $item->judul }}</td>
                            <td class="border p-2 text-center capitalize">{{ $item->status }}</td>
                            <td class="border p-2 text-center">{{ $item->tanggal }}</td>

                            <td class="border p-2 text-center">
                                @if ($item->thumbnail)
                                    <img src="{{ asset('storage/' . $item->thumbnail) }}"
                                         class="h-16 w-24 object-cover mx-auto rounded">
                                @else
                                    -
                                @endif
                            </td>

                            <td class="border p-2 text-center">
                                <a href="{{ route('edit-artikel', $item->id) }}"
                                   class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                    Edit
                                </a>

                                <button wire:click="confirmDelete({{ $item->id }})"
                                        class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

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
