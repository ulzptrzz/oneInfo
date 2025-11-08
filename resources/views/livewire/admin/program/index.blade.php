<div class="p-6">
    <h1 class="text-2xl font-bold mb-4 text-gray-800">Manajemen Program</h1>

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-3">{{ session('message') }}</div>
    @endif

    <div class="flex justify-between mb-4">
        <input type="text" wire:model.live="search" placeholder="Cari program..." class="border rounded px-3 py-2 w-1/3">
        <button wire:click="openModal" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">+ Tambah Program</button>
    </div>

    <table class="w-full border-collapse bg-white shadow rounded-lg">
        <thead class="bg-gray-100">
            <tr class="text-left">
                <th class="px-4 py-2 border">#</th>
                <th class="px-4 py-2 border">Nama Program</th>
                <th class="px-4 py-2 border">Kategori</th>
                <th class="px-4 py-2 border">Deskripsi</th>
                <th class="px-4 py-2 border">Gambar</th>
                <th class="px-4 py-2 border text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($programs as $program)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2 border">{{ $program->nama_program }}</td>
                    <td class="px-4 py-2 border">{{ $program->kategori->nama ?? '-' }}</td>
                    <td class="px-4 py-2 border">{{ Str::limit($program->deskripsi, 50) }}</td>
                    <td class="px-4 py-2 border">
                        @if($program->gambar)
                            <img src="{{ asset('storage/'.$program->gambar) }}" class="w-16 rounded">
                        @endif
                    </td>
                    <td class="px-4 py-2 border text-center">
                        <button wire:click="edit({{ $program->id }})" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">Edit</button>
                        <button wire:click="delete({{ $program->id }})" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        {{ $programs->links() }}
    </div>

    {{-- Modal Form --}}
    @if ($isModalOpen)
        <div class="fixed inset-0 bg-black/40 flex items-center justify-center">
            <div class="bg-white rounded-lg shadow-lg w-1/2 p-6">
                <h2 class="text-xl font-semibold mb-4">{{ $program_id ? 'Edit Program' : 'Tambah Program' }}</h2>

                <form wire:submit.prevent="save">
                    <div class="space-y-3">
                        <div>
                            <label>Nama Program</label>
                            <input type="text" wire:model="nama_program" class="w-full border rounded px-3 py-2">
                            @error('nama_program') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label>Kategori</label>
                            <select wire:model="kategori_program_id" class="w-full border rounded px-3 py-2">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                @endforeach
                            </select>
                            @error('kategori_program_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label>Deskripsi</label>
                            <textarea wire:model="deskripsi" class="w-full border rounded px-3 py-2" rows="3"></textarea>
                        </div>

                        <div>
                            <label>Gambar</label>
                            <input type="file" wire:model="gambar" class="w-full border rounded px-3 py-2">
                            @if ($gambar)
                                <img src="{{ $gambar->temporaryUrl() }}" class="w-24 mt-2 rounded">
                            @endif
                        </div>
                    </div>

                    <div class="mt-5 flex justify-end gap-2">
                        <button type="button" wire:click="closeModal" class="px-4 py-2 bg-gray-500 text-white rounded">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
