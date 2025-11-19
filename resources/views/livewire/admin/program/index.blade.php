<div class="flex min-h-screen">
    <style>
        .table-row:hover {
            background-color: #f8fafc;
        }
    </style>

    <x-sidebar active="program" />

    <div class="w-full mx-8 my-7 bg-white rounded-2xl shadow-md overflow-hidden">
        {{-- Header --}}
        <div class="bg-[#0C356A] text-white p-7 flex justify-between items-center">
            <h2 class="text-2xl font-bold items-center">Daftar Program</h2>
            <div class="flex gap-5 justify-end">
                <a href="{{ route('admin.kategori-program') }}"
                    class="bg-[#ffc436] text-[#0C356A] font-semibold px-4 py-2 rounded-lg hover:bg-yellow-400 transition">
                    + Tambah Kategori
                </a>
                <a href="{{ route('create-program') }}"
                    class="bg-[#ffc436] text-[#0C356A] font-semibold px-4 py-2 rounded-lg hover:bg-yellow-400 transition">
                    + Tambah Program
                </a>
            </div>
        </div>

        {{-- Success Message --}}
        @if (session()->has('message'))
        <div class="bg-green-50 border-l-4 border-green-500 text-green-800 px-6 py-4 flex items-center gap-3">
            <i class='bx bx-check-circle text-2xl'></i>
            <span class="font-medium">{{ session('message') }}</span>
        </div>
        @endif

        {{-- Content --}}
        @if($program->isEmpty())
        {{-- Empty State --}}
        <div class="text-center py-16 px-6">
            <i class='bx bx-book text-6xl text-gray-300 mb-4'></i>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Program</h3>
            <p class="text-gray-500 mb-6">Mulai tambahkan program untuk siswa</p>
            <a href="{{ route('create-program') }}"
                class="inline-flex items-center gap-2 bg-[#FFC436] text-[#0C356A] font-semibold px-6 py-2.5 rounded-lg hover:bg-yellow-400">
                <i class='bx bx-plus text-xl'></i>
                Tambah Program
            </a>
        </div>
        @else
        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-100 border-b-2 border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            No
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Nama Program
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Poster
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Kategori
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($program as $item)

                    @php
                    $statusColor = $item->status === 'published' ? 'bg-green-500 text-green-800' :
                    ($item->status === 'draft' ? 'bg-yellow-500 text-yellow-800' :
                    'bg-gray-500 text-gray-800');
                    @endphp

                    <tr class="table-row">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm font-medium text-gray-900">{{ $loop->iteration }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-medium text-gray-900">{{ $item->name }}</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-block mt-2 px-3 py-1 text-xs font-semibold text-white rounded-full {{ $statusColor }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if ($item->poster)
                            <div class="flex justify-center">
                                <a href="{{ asset('storage/' . $item->poster) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $item->poster) }}"
                                        alt="Poster"
                                        class="h-16 w-24 object-cover rounded-lg border-2 border-gray-200 hover:border-[#FFC436] transition cursor-pointer">
                                </a>
                            </div>
                            @else
                            <span class="text-sm text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="text-sm text-gray-700">{{ $item->kategoriProgram->nama_kategori }}</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('detail-program', $item->id) }}"
                                    class="bg-yellow-500 text-white px-3 py-1.5 rounded-lg hover:bg-yellow-600 text-sm font-medium inline-flex items-center gap-1 transition">
                                    <i class='bx bx-eye'></i>
                                    Detail
                                </a>
                                <a href="{{ route('edit-program', $item->id) }}"
                                    class="bg-blue-500 text-white px-3 py-1.5 rounded-lg hover:bg-blue-600 text-sm font-medium inline-flex items-center gap-1 transition">
                                    <i class='bx bx-edit'></i>
                                    Edit
                                </a>
                                <button
                                    wire:click="delete({{ $item->id }})"
                                    wire:confirm="Apakah kamu yakin ingin menghapus program '{{ $item->name }}'?"
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