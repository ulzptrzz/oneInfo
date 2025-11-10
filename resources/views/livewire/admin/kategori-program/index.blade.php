<div class="flex min-h-screen">
    <x-sidebar />

    <div class="w-full mx-10 mt-10 bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="bg-[#0C356A] text-white p-7 flex justify-between items-center">
            @if (session()->has('message'))
            <div class="bg-green-100 text-green-800 px-3 py-2 rounded mb-3">
                {{ session('message') }}
            </div>
            @endif
            <h2 class="text-2xl font-bold flex items-center gap-2">Daftar Kategori Program</h2>
            <a href="{{ route('create-kategori') }}"
                class="bg-[#ffc436] text-white font-semibold px-4 py-2 rounded-lg hover:bg-yellow-900 transition">
                + Tambah Kategori
            </a>
        </div>


        <div class="overflow-x-auto">
            <table class="min-w-full text-gray-700 m-4">
                <thead class="bg-gray-800 text-white rounded-2xl">
                    <tr>
                        <th class="border p-2">No</th>
                        <th class="border p-2">Nama</th>
                        <th class="border p-2">Deskripsi</th>
                        <th class="border p-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kategoriProgram as $index => $item)
                    <tr>
                        <td class="border p-2 text-center">{{ $loop->iteration }}</td>
                        <td class="border p-2 text-center">{{ $item->nama_kategori }}</td>
                        <td class="border p-2 text-center">{{ $item->deskripsi ?? '-' }}</td>
                        <td class="border p-2 text-center">
                            <a href="{{ route('edit-kategori', $item->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-500">Edit</a>
                            <button wire:click="delete({{ $item->id }})" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Hapus</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
    </div>
</div>