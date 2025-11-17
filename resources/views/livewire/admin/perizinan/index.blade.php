<div class="flex min-h-screen">
    <style>
        .table-row:hover {
            background-color: #f8fafc;
        }
    </style>

    <x-sidebar active="perizinan" />
    
    <div class="w-full mx-10 mt-10 bg-white rounded-2xl shadow-md overflow-hidden">
        {{-- Header --}}
        <div class="bg-[#0C356A] text-white p-7 flex justify-between items-center">
            <h2 class="text-2xl font-bold flex items-center gap-2">Daftar Perizinan</h2>
            <a href="{{ route('create-perizinan') }}"
                class="bg-[#ffc436] text-[#0C356A] font-semibold px-4 py-2 rounded-lg hover:bg-yellow-400 transition">
                + Tambah Perizinan
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
        @if($perizinan->isEmpty())
            {{-- Empty State --}}
            <div class="text-center py-16 px-6">
                <i class='bx bx-file-blank text-6xl text-gray-300 mb-4'></i>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Perizinan</h3>
                <p class="text-gray-500 mb-6">Mulai tambahkan perizinan untuk program sekolah</p>
                <a href="{{ route('create-perizinan') }}"
                    class="inline-flex items-center gap-2 bg-[#FFC436] text-[#0C356A] font-semibold px-6 py-2.5 rounded-lg hover:bg-yellow-400">
                    <i class='bx bx-plus text-xl'></i>
                    Tambah Perizinan
                </a>
            </div>
        @else
            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-[#0C356A]">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                No
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Nama Program
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Kategori
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Deskripsi
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider">
                                Gambar
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($perizinan as $item)
                            <tr class="table-row">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-medium text-gray-900">{{ $loop->iteration }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm font-medium text-gray-900">{{ $item->nama_program }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-700">{{ $item->kategori }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-700">{{ Str::limit($item->deskripsi, 50) ?? '-' }}</span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if ($item->gambar)
                                        <div class="flex justify-center">
                                            <a href="{{ asset('storage/' . $item->gambar) }}" target="_blank">
                                                <img src="{{ asset('storage/' . $item->gambar) }}" 
                                                     alt="Gambar"
                                                     class="h-16 w-24 object-cover rounded-lg border-2 border-gray-200 hover:border-[#FFC436] transition cursor-pointer">
                                            </a>
                                        </div>
                                    @else
                                        <span class="text-sm text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('edit-perizinan', $item->id) }}"
                                           class="bg-blue-500 text-white px-3 py-1.5 rounded-lg hover:bg-blue-600 text-sm font-medium inline-flex items-center gap-1 transition">
                                            <i class='bx bx-edit'></i>
                                            Edit
                                        </a>
                                        <button 
                                            wire:click="delete({{ $item->id }})"
                                            wire:confirm="Apakah kamu yakin ingin menghapus perizinan '{{ $item->nama_program }}'?"
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

            {{-- Footer Info --}}
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                <p class="text-sm text-gray-600">
                    Total: <span class="font-semibold text-[#0C356A]">{{ $perizinan->count() }}</span> perizinan
                </p>
            </div>
        @endif
    </div>
</div>