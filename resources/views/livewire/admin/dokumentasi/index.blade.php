<div class="flex min-h-screen">
    <style>
        .table-row:hover {
            background-color: #f8fafc;
        }
    </style>

    <x-sidebar />
    
    <div class="w-full mx-10 mt-10 bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="bg-[#0C356A] text-white p-7 flex justify-between items-center">
            @if (session()->has('message'))
            <div class="bg-green-100 text-green-800 px-3 py-2 rounded mb-3">
                {{ session('message') }}
            </div>
            @endif
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
        @if($dokumentasi->isEmpty())
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
                                <tr class="table-row">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm font-medium text-gray-900">{{ $loop->iteration }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-sm font-medium text-gray-900">{{ $item->judul }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if ($item->foto)
                                            <div class="flex justify-center">
                                                <a href="{{ asset('storage/' . $item->foto) }}" target="_blank">
                                                    <img src="{{ asset('storage/' . $item->foto) }}" 
                                                         alt="Foto"
                                                         class="h-16 w-24 object-cover rounded-lg border-2 border-gray-200 hover:border-[#FFC436] transition cursor-pointer">
                                                </a>
                                            </div>
                                        @else
                                            <span class="text-sm text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if ($item->video)
                                            <a href="{{ $item->video }}" target="_blank"
                                               class="inline-flex items-center gap-1 text-sm text-blue-600 hover:text-blue-800 font-medium">
                                                <i class='bx bx-link-external'></i>
                                                Lihat
                                            </a>
                                        @else
                                            <span class="text-sm text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('edit-dokumentasi', $item->id) }}"
                                               class="bg-blue-500 text-white px-3 py-1.5 rounded-lg hover:bg-blue-600 text-sm font-medium inline-flex items-center gap-1">
                                                <i class='bx bx-edit'></i>
                                                Edit
                                            </a>
                                            <button 
                                                wire:click="delete({{ $item->id }})"
                                                wire:confirm="Apakah kamu yakin ingin menghapus dokumentasi '{{ $item->judul }}'?"
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
    </div>
</div>