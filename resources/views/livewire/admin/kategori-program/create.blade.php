<div class="min-h-screen items-center">
    <div class="w-80 mx-10 mt-10 bg-[#0C356A] rounded-2xl shadow-md">
        <div class="p-8">

            <h2 class="font-semibold text-xl pb-8 text-white text-center">Tambah Kategori</h2>
            <form wire:submit="save" class="space-y-4">
                <div>
                    <label for="" class="block font-semibold text-white text-md">Nama Kategori</label>
                    <input type="text" id="" wire:model="nama_kategori" placeholder="" class="w-full px-4 py-3 border" />
        
                </div>
                <div>
                    <label for="" class="block font-semibold text-white text-md">Deskripsi Kategori</label>
                    <textarea id="" wire:model="deskripsi" placeholder="" class="w-full px-4 py-3 border"></textarea>
                </div>
        
                <div class="">
                    <a href="{{ route('create-kategori') }}" class="bg-red-400 px-5 py-1 text-lg font-semibold rounded-xl">Batal</a>
                    <button type="submit" class="bg-[#ffc436] px-5 py-1 text-lg font-semibold rounded-xl">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>