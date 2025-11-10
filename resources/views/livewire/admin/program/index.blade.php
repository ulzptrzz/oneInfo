<div class="flex min-h-screen">
    <x-sidebar />
    <div class="p-6">
        @if (session()->has('message'))
        <div class="bg-green-100 text-green-800 px-3 py-2 rounded mb-3">
            {{ session('message') }}
        </div>
        @endif

        <div class="flex justify-between mb-4">
            <h2 class="text-lg font-semibold">Daftar Program</h2>
            <a href="{{ route('create-program') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Tambah Program
            </a>
        </div>

        <table class="w-full border-collapse border border-gray-300">
            <thead class="">
                <tr>
                    <th class="border p-2">No</th>
                    <th class="border p-2">Nama</th>
                    <th class="border p-2">Deskripsi</th>
                    <th class="border p-2">Tanggal Mulai</th>
                    <th class="border p-2">Tanggal Selesai</th>
                    <th class="border p-2">Status</th>
                    <th class="border p-2">Poster</th>
                    <th class="border p-2">Penyelenggara</th>
                    <th class="border p-2">Tingkat</th>
                    <th class="border p-2">Mata Lomba</th>
                    <th class="border p-2">Kategori</th>
                    <th class="border p-2">user_id</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($program as $item)
                <tr>
                    <td class="border p-2 text-center">{{ $loop->iteration }}</td>
                    <td class="border p-2 text-center">{{ $item->nama_kategori }}</td>
                    <td class="border p-2 text-center">{{ $item->deskripsi }}</td>
                    <td class="border p-2 text-center">{{ $item->tanggal_mulai }}</td>
                    <td class="border p-2 text-center">{{ $item->tanggal_selesai }}</td>
                    <td class="border p-2 text-center">{{ $item->status }}</td>
                    <td class="border p-2 text-center">
                        <img src="{{ asset('storage/' . $item->poster) }}" alt="poster" class="w-32 rounded">
                    </td>
                    <td class="border p-2 text-center">{{ $item->penyelenggara }}</td>
                    <td class="border p-2 text-center">{{ $item->tingkat }}</td>
                    <td class="border p-2 text-center">{{ $item->mata_lomba }}</td>
                    <td class="border p-2 text-center">{{ $item->kategori_program_id }}</td>
                    <td class="border p-2 text-center">{{ $item->user_id }}</td>
                    <td class="border p-2 text-center">
                        <a href="{{ route('edit-program', $item->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-500">Edit</a>
                        <button wire:click="delete({{ $item->program_id }})" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Hapus</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3">
        </div>
    </div>
</div>