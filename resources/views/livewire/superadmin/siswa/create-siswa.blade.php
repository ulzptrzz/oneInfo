<div class="flex min-h-screen">
    <!-- Sidebar -->
    <x-sidebar-superadmin />

    <!-- Konten Utama -->
    <div class="flex-1 p-8 bg-gray-50">
        <h1 class="mb-6 text-2xl font-bold text-[#0C356A]">Tambah Siswa</h1>

        <form wire:submit.prevent="store" class="space-y-5 bg-white p-6 rounded-lg shadow">
            <!-- Nama Siswa -->
            <div>
                <label class="block font-semibold text-gray-700 mb-1">Nama Siswa</label>
                <input type="text" wire:model="name" class="border p-2 w-full rounded">
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- NIS -->
            <div>
                <label class="block font-semibold text-gray-700 mb-1">NIS</label>
                <input type="text" wire:model="nis" class="border p-2 w-full rounded">
                @error('nis')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- NISN -->
            <div>
                <label class="block font-semibold text-gray-700 mb-1">NISN</label>
                <input type="text" wire:model="nisn" class="border p-2 w-full rounded">
                @error('nisn')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Foto -->
            <div>
                <label class="block font-semibold text-gray-700 mb-1">Foto</label>
                <input type="file" wire:model="foto" class="border p-2 w-full rounded">

                @if ($foto)
                    <div class="mt-3">
                        <img src="{{ $foto->temporaryUrl() }}" class="w-40 rounded shadow" alt="preview foto">
                    </div>
                @endif

                @error('foto')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Kelas -->
            <div>
                <label class="block font-semibold text-gray-700 mb-1">Kelas</label>
                <select id="" wire:model="kelas_id" class="border p-2 w-full rounded">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach ($kelas_siswa as $kelas)
                        <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                    @endforeach
                </select>
                @error('kelas')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tombol Aksi -->
            <div class="flex gap-4 pt-4">
                <a href="{{ route('superadmin.siswa.akun-siswa') }}"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition">
                    Batal
                </a>
                <button type="submit"
                    class="bg-[#0C356A] text-white px-4 py-2 rounded hover:bg-[#092a52] transition">
                    Tambah Siswa
                </button>
            </div>
        </form>
    </div>
</div>
