<div class="flex min-h-screen">
    <x-sidebar />

    <div class="w-full mx-10 mt-10 bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="bg-[#0C356A] text-white p-7 flex justify-between items-center">
            <h2 class="text-2xl font-bold flex items-center gap-2">
                <i class='bx bx-medal text-2xl'></i>
                Daftar Prestasi
            </h2>

            <a href="{{ route('create-prestasi') }}"
                class="bg-[#FFC436] text-white font-semibold px-4 py-2 rounded-lg hover:bg-yellow-900 transition">
                + Tambah Prestasi
            </a>
        </div>

        @if (session()->has('message'))
            <div class="bg-green-100 text-green-800 px-3 py-2 rounded m-4">
                {{ session('message') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full text-gray-700 m-4">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="border p-2">No</th>
                        <th class="border p-2">Tanggal</th>
                        <th class="border p-2">Deskripsi</th>
                        <th class="border p-2">Siswa</th>
                        <th class="border p-2">Program</th>
                        <th class="border p-2">Dokumentasi</th>
                        <th class="border p-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prestasi as $item)
                        <tr>
                            <td class="border p-2 text-center">{{ $loop->iteration }}</td>
                            <td class="border p-2 text-center">{{ $item->tanggal }}</td>
                            <td class="border p-2 text-center">{{ $item->deskripsi }}</td>
                            <td class="border p-2 text-center">{{ $item->siswa->name ?? '-' }}</td>
                            <td class="border p-2 text-center">{{ $item->program->name ?? '-' }}</td>
                            <td class="border p-2 text-center">
                                @if ($item->dokumentasi && $item->dokumentasi->foto)
                                    <img src="{{ asset('storage/' . $item->dokumentasi->foto) }}" class="h-16 w-24 object-cover mx-auto rounded">
                                @else
                                    -
                                @endif
                            </td>
                            <td class="border p-2 text-center">
                                <a href="{{ route('edit-prestasi', $item->id) }}"
                                   class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                                <button wire:click="delete({{ $item->id }})"
                                        class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
