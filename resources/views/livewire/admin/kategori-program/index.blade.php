<div>
    @section('title', 'Manajemen Kategori Program')

    <div>
        <h1 class="text-2xl font-bold mb-6">Manajemen Kategori Program</h1>

        <form wire:submit.prevent="save" class="flex gap-3 mb-6">
            <input wire:model.defer="nama" type="text" placeholder="Nama kategori" class="border rounded px-3 py-2 flex-1">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                {{ $isEditing ? 'Update' : 'Tambah' }}
            </button>
        </form>

        @error('nama') <p class="text-red-600 text-sm mb-3">{{ $message }}</p> @enderror

        <table class="min-w-full bg-white rounded-lg shadow">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 text-left">#</th>
                    <th class="p-3 text-left">Nama</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kategoris as $index => $k)
                <tr class="border-t">
                    <td class="p-3">{{ $index + 1 }}</td>
                    <td class="p-3">{{ $k->nama }}</td>
                    <td class="p-3 space-x-2">
                        <button wire:click="edit({{ $k->id }})" class="text-blue-600 hover:underline">Edit</button>
                        <button wire:click="delete({{ $k->id }})" class="text-red-600 hover:underline">Hapus</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>