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
                Daftar Prestasi
            </h2>

            <a href="{{ route('create-prestasi') }}"
                class="bg-[#FFC436] text-[#0C356A] font-semibold px-4 py-2 rounded-lg hover:bg-yellow-400 transition">
                + Tambah Prestasi
            </a>
        </div>

        {{-- Success Message --}}
        @if (session()->has('message'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-800 px-6 py-4 flex items-center gap-3">
                <i class='bx bx-check-circle text-2xl'></i>
                <span class="font-medium">{{ session('message') }}</span>
            </div>
        @endif

        {{-- If Empty --}}
        @if($prestasi->isEmpty())
            <div class="text-center py-16 px-6">
                <i class='bx bx-medal text-6xl text-gray-300 mb-4'></i>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Prestasi</h3>
                <p class="text-gray-500 mb-6">Tambah data prestasi siswa untuk ditampilkan di sini</p>

                <a href="{{ route('create-prestasi') }}"
                    class="inline-flex items-center gap-2 bg-[#FFC436] text-[#0C356A] font-semibold px-6 py-2.5 rounded-lg hover:bg-yellow-400">
                    <i class='bx bx-plus text-xl'></i>
                    Tambah Prestasi
                </a>
            </div>

        @else
            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-100 border-b-2 border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Deskripsi</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Siswa</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Program</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Dokumentasi</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @foreach ($prestasi as $item)
                            <tr class="table-row">

                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800">
                                    {{ $item->deskripsi }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800">
                                    {{ $item->siswa->name ?? '-' }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-800">
                                    {{ $item->program->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if ($item->dokumentasi && $item->dokumentasi->foto)
                                        <div class="flex justify-center">
                                            <a href="{{ asset('storage/' . $item->dokumentasi->foto) }}" target="_blank">
                                                <img src="{{ asset('storage/' . $item->dokumentasi->foto) }}"
                                                     class="h-16 w-24 object-cover rounded-lg border-2 border-gray-200 hover:border-[#FFC436] transition cursor-pointer">
                                            </a>
                                        </div>
                                    @else
                                        <span class="text-sm text-gray-400">-</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('edit-prestasi', $item->id) }}"
                                           class="bg-blue-500 text-white px-3 py-1.5 rounded-lg hover:bg-blue-600 text-sm inline-flex items-center gap-1">
                                            <i class='bx bx-edit'></i>
                                            Edit
                                        </a>

                                        <button 
                                            wire:click="delete({{ $item->id }})"
                                            wire:confirm="Yakin ingin menghapus prestasi ini?"
                                            class="bg-red-500 text-white px-3 py-1.5 rounded-lg hover:bg-red-600 text-sm inline-flex items-center gap-1">
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
