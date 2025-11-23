<div class="flex min-h-screen">

    <aside class="fixed overflow-y-auto">
        <x-sidebar-superadmin />
    </aside>

    {{-- KONTEN UTAMA --}}
    <div class="flex-1 ml-64 mr-20 min-h-screen">
        <div class="w-full mx-8 my-7 bg-white rounded-2xl shadow-md overflow-hidden">

            <div class="bg-[#0C356A] text-white p-8">
                <h1 class="text-3xl font-bold flex items-center gap-3">
                    Tambah Jurusan
                </h1>
            </div>

            <form wire:submit.prevent="store" class="space-y-5 bg-white p-6 rounded-lg shadow">
                <!-- Nama Jurusan -->
                <div>
                    <label class="block font-semibold text-gray-700 mb-1">Nama Jurusan</label>
                    <input type="text" wire:model="nama_jurusan" class="border p-2 w-full rounded">
                    @error('nama_jurusan')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block font-semibold text-gray-700 mb-1">deskripsi</label>
                    <input type="text" wire:model="deskripsi" class="border p-2 w-full rounded">
                    @error('deskripsi')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>


                <!-- Tombol Aksi -->
                <div class="flex gap-4 pt-4">
                    <a href="{{ route('superadmin.siswa.kelola-jurusan') }}"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="bg-[#0C356A] text-white px-4 py-2 rounded hover:bg-[#092a52] transition">
                        Tambah Jurusan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>