<div class="flex min-h-screen">
    <x-sidebar/>
    <div class="p-6">
        @if (session()->has('message'))
            <div class="bg-green-100 text-green-800 px-3 py-2 rounded mb-3">
                {{ session('message') }}
            </div>
        @endif
    
        <div class="flex justify-between mb-4">
            <h2 class="text-2xl font-bold">Daftar Kategori Program</h2>
            <a href="{{ route('create-kategori') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
               + Tambah Kategori
            </a>
        </div>
    
        <table class="w-full border-collapse border border-gray-300 rounded-xl">
            <thead class="rounded-2xl">
                <tr>
                    <th class="border p-2">No
                    </th>
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
    
        <div class="mt-3">
        </div>
    </div>
</div>

