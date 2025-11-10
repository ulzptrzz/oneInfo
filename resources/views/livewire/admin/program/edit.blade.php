<div>
    <h2>Tambah Program</h2>
    <form wire:submit="update" class="space-y-4">
        <div>
            <label for="" class="block text-sm font-semibold">Nama Program</label>
            <input type="text" id="" wire:model="nama_program" placeholder="" class="w-full px-4 py-3 border" />
        </div>
        <div>
            <label for="" class="block text-sm font-semibold">Deskripsi</label>
            <textarea id="" wire:model="deskripsi" placeholder="" class="w-full px-4 py-3 border"></textarea>
        </div>
        <div>
            <label for="" class="block text-sm font-semibold">Tanggal Mulai</label>
            <input type="date" id="" wire:model="tanggal_mulai" placeholder="" class="w-full px-4 py-3 border" />
        </div>
        <div>
            <label for="" class="block text-sm font-semibold">Tanggal Selesai</label>
            <input type="date" id="" wire:model="tanggal_selesai" placeholder="" class="w-full px-4 py-3 border" />
        </div>
        <div>
            <label for="" class="block text-sm font-semibold">Status</label>
            <select id="" wire:model="status" placeholder="" class="w-full px-4 py-2 border rounded">
                <option value="">-- Pilih Status --</option>
                <option value="draft">Draft</option>
                <option value="published">Published</option>
                <option value="archived">Archived</option>
            </select>
        </div>
        <div>
            <label for="" class="block text-sm font-semibold">Poster</label>
            <input type="file" id="" wire:model="poster" placeholder="" class="w-full px-4 py-3 border" />

            @if ($poster)
                <div class="mt-2">
                    <img src="{{ $poster->temporaryUrl() }}" class="w-40 rounded shadow" alt="preview poster">
                </div>
            @else
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $oldPoster) }}" class="w-40 rounded shadow" alt="poster lama">
                </div>
            @endif
        </div>
        <div>
            <label for="" class="block text-sm font-semibold">Penyelenggara</label>
            <input type="text" id="" wire:model="penyelenggara" placeholder="" class="w-full px-4 py-3 border" />
        </div>
        <div>
            <label for="" class="block text-sm font-semibold">Tingkat</label>
            <input type="text" id="" wire:model="tingkat" placeholder="" class="w-full px-4 py-3 border" />
        </div>
        <div>
            <label for="" class="block text-sm font-semibold">Mata Lomba</label>
            <input type="text" id="" wire:model="mata_lomba" placeholder="" class="w-full px-4 py-3 border" />
        </div>
        <div>
            <label for="" class="block text-sm font-semibold">Kategori</label>
            <select id="" wire:model="kategori_program_id" placeholder="" class="w-full px-4 py-3 border">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategori as $kat)
                    <option value="{{ $kat->kategori_program_id }}">{{ $kat->nama_kategori }}</option>
                @endforeach
            </select>
        </div>

        <div class="">
            <a href="{{ route('create-program') }}" class="">Batal</a>
            <button type="submit">Update</button>
        </div>
    </form>
</div>