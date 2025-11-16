<div class="flex min-h-screen">
    <x-sidebar />

    <div class="w-full mx-10 mt-10 bg-white rounded-2xl shadow-md overflow-hidden">

        {{-- Header --}}
        <div class="bg-[#0C356A] text-white p-7 flex justify-between items-center">
            <h2 class="text-2xl font-bold flex items-center gap-2">
                <i class='bx bx-news text-2xl'></i>
                Edit Artikel
            </h2>
        </div>

        <div class="p-8">

            {{-- Alert --}}
            @if (session()->has('message'))
                <div class="bg-green-100 text-green-800 px-3 py-2 rounded mb-4">
                    {{ session('message') }}
                </div>
            @endif

            <form wire:submit.prevent="update" class="space-y-5">

                <div>
                    <label class="font-semibold">Judul</label>
                    <input type="text" wire:model="judul"
                        class="w-full p-2 border rounded">
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
                    <label class="font-semibold">Thumbnail Baru</label>
                    <input type="file" wire:model="thumbnail" class="w-full p-2 border rounded">
                    @error('thumbnail') <small class="text-red-600">{{ $message }}</small> @enderror
                </div>

                <div class="mt-3">
                    <p class="text-sm text-gray-600 mb-2">Thumbnail Lama:</p>
                    <img src="{{ asset('storage/' . $thumbnail_lama) }}"
                         class="h-32 object-cover rounded shadow">
                </div>

                {{-- Thumbnail preview kalau upload baru --}}
                @if ($thumbnail)
                    <div class="mt-3">
                        <p class="text-sm text-gray-600 mb-1">Preview Thumbnail Baru:</p>
                        <img src="{{ $thumbnail->temporaryUrl() }}"
                             class="h-32 object-cover rounded shadow">
                    </div>
                @endif

                <button type="submit"
                    class="bg-[#FFC436] text-white font-semibold px-4 py-2 rounded-lg hover:bg-yellow-900 transition">
                    Update
                </button>

            </form>

        </div>
    </div>
</div>
