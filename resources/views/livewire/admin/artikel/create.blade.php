<div class="flex min-h-screen">
    <x-sidebar />

    <div class="w-full mx-10 mt-10 bg-white rounded-2xl shadow-md overflow-hidden">

        {{-- Header --}}
        <div class="bg-[#0C356A] text-white p-7 flex justify-between items-center">
            <h2 class="text-2xl font-bold flex items-center gap-2">
                <i class='bx bx-news text-2xl'></i>
                Tambah Artikel
            </h2>
        </div>

        <div class="p-8">

            {{-- Alert --}}
            @if (session()->has('message'))
                <div class="bg-green-100 text-green-800 px-3 py-2 rounded mb-4">
                    {{ session('message') }}
                </div>
            @endif

            <form wire:submit.prevent="save" class="space-y-5">

                <div>
                    <label class="font-semibold">Judul</label>
                    <input type="text" wire:model="judul"
                        class="w-full p-2 border rounded" placeholder="Judul artikel">
                    @error('judul') <small class="text-red-600">{{ $message }}</small> @enderror
                </div>

                <div>
                    <label class="font-semibold">Deskripsi</label>
                    <textarea wire:model="deskripsi" rows="5"
                        class="w-full p-2 border rounded"></textarea>
                    @error('deskripsi') <small class="text-red-600">{{ $message }}</small> @enderror
                </div>

                <div>
                    <label class="font-semibold">Status</label>
                    <select wire:model="status" class="w-full p-2 border rounded">
                        <option value="draft">Draft</option>
                        <option value="publised">Publised</option>
                        <option value="archived">Archived</option>
                    </select>
                    @error('status') <small class="text-red-600">{{ $message }}</small> @enderror
                </div>

                <div>
                    <label class="font-semibold">Tanggal</label>
                    <input type="date" wire:model="tanggal" class="w-full p-2 border rounded">
                    @error('tanggal') <small class="text-red-600">{{ $message }}</small> @enderror
                </div>

                <div>
                    <label class="font-semibold">Thumbnail</label>
                    <input type="file" wire:model="thumbnail" class="w-full p-2 border rounded">
                    @error('thumbnail') <small class="text-red-600">{{ $message }}</small> @enderror
                </div>

            

                <div class="flex justify-between items-center mt-6">
                <!-- Tombol Back -->
                <a href="{{ route('admin.artikel') }}"
                    class="bg-gray-300 text-gray-700 font-semibold px-4 py-2 rounded-lg 
                        hover:bg-gray-400 transition flex items-center gap-2">
                    <i class='bx bx-arrow-back text-xl'></i>
                    Kembali
                </a>

    <!-- Tombol Simpan -->
    <button type="submit"
        class="bg-[#FFC436] text-white font-semibold px-4 py-2 rounded-lg 
               hover:bg-yellow-900 transition">
        Simpan
    </button>
</div>


            </form>

        </div>
    </div>
</div>
