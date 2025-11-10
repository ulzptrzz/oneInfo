<div>
    <h2>Tambah Kategori</h2>
    <form wire:submit="save" class="space-y-4">
        <div>
            <label for="" class="block text-sm font-semibold">Nama Kategori</label>
            <input type="text" id="" wire:model="nama_kategori" placeholder="" class="w-full px-4 py-3 border" />

        </div>
        <div>
            <label for="" class="block text-sm font-semibold">Deskripsi Kategori</label>
            <textarea id="" wire:model="deskripsi" placeholder="" class="w-full px-4 py-3 border"></textarea>
        </div>

        <div class="">
            <a href="{{ route('create-kategori') }}" class="">Batal</a>
            <button type="submit">Simpan</button>
        </div>
    </form>
</div>