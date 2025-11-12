<div class="min-h-screen items-center">
    <div class="w-80 mx-10 mt-10 bg-[#0C356A] rounded-2xl shadow-md">
        <div class="p-8">
            <h2 class="font-semibold text-xl pb-8 text-white text-center">Tambah Program</h2>
            <form wire:submit="save" class="space-y-4">
                <div>
                    <label for="" class="block font-semibold text-white text-md">Nama Program</label>
                    <input type="text" id="" wire:model="name" placeholder="" class="w-full px-4 py-3 border" />
                </div>
                <div>
                    <label for="" class="block font-semibold text-white text-md">Deskripsi</label>
                    <textarea id="" wire:model="deskripsi_singkat" placeholder="" class="w-full px-4 py-3 border"></textarea>
                </div>
                <div>
                    <label for="" class="block font-semibold text-white text-md">Tanggal Mulai</label>
                    <input type="date" id="" wire:model="tanggal_mulai" placeholder="" class="w-full px-4 py-3 border" />
                </div>
                <div>
                    <label for="" class="block font-semibold text-white text-md">Tanggal Selesai</label>
                    <input type="date" id="" wire:model="tanggal_selesai" placeholder="" class="w-full px-4 py-3 border" />
                </div>
                <div>
                    <label for="" class="block font-semibold text-white text-md">Status</label>
                    <select id="" wire:model="status" placeholder="" class="w-full px-4 py-2 border rounded">
                        <option value="">-- Pilih Status --</option>
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                        <option value="archived">Archived</option>
                    </select>
                </div>
                <div>
                    <label for="" class="block font-semibold text-white text-md">Poster</label>
                    <input type="file" id="" wire:model="poster" placeholder="" class="w-full px-4 py-3 border" />

                    @if ($poster)
                    <div class="mt-2">
                        <img src="{{ $poster->temporaryUrl() }}" class="w-40 rounded shadow" alt="preview poster">
                    </div>
                    @endif
                </div>
                <div>
                    <label for="" class="block font-semibold text-white text-md">Penyelenggara</label>
                    <input type="text" id="" wire:model="penyelenggara" placeholder="" class="w-full px-4 py-3 border" />
                </div>
                <div>
                    <label for="" class="block font-semibold text-white text-md">Tingkat</label>
                    <select wire:model="tingkat" class="w-full border rounded">
                        <option value="">-- Pilih Tingkat --</option>
                        <option value="nasional">Nasional</option>
                        <option value="provinsi">Provinsi</option>
                        <option value="kabupaten">Kabupaten</option>
                    </select>
                </div>
                <div>
                    <label for="" class="block font-semibold text-white text-md">Mata Lomba</label>
                    <input type="text" id="" wire:model="mata_lomba" placeholder="" class="w-full px-4 py-3 border" />
                </div>
                <div>
                    <label for="" class="block font-semibold text-white text-md">Kategori</label>
                    <select id="" wire:model="kategori_program_id" placeholder="" class="w-full px-4 py-3 border">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategori_program as $kat)
                        <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="">
                    <a href="{{ route('admin.program') }}" class="bg-red-400 px-5 py-1 text-lg font-semibold rounded-xl">Batal</a>
                    <button type="submit" class="bg-[#ffc436] px-5 py-1 text-lg font-semibold rounded-xl">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>