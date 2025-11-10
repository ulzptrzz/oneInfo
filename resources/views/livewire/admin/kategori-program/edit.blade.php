<div>
    <h2>Edit Kategori Program</h2>

    <form wire:submit="update" class="space-y-4">
        <div>
            <label for="" class="block text-sm font-semibold">Nama Kategori</label>
            <input type="" id="" wire:model="nama_kategori" placeholder="" class="w-full px-4 py-3 border" />
        </div>
        <div>
            <label for="" class="block text-sm font-semibold">Deskripsi</label>
            <textarea type="" id="" wire:model="deskripsi" placeholder="" class="w-full px-4 py-3 border"></textarea>
        </div>

        <div>
            <a href="{{ route('admin.kategori-program') }}">Batal</a>
            <button type="submit">Update</button>
        </div>
    </form>
</div>
