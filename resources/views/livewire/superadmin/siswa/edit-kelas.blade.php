<div>
    <div class="flex min-h-screen">
        <x-sidebar-superadmin />

        <div class="flex-1 p-8 bg-gray-50">
            <h1 class="mb-5 text-2xl font-bold text-[#0C356A]">Edit Kelas</h1>

            <form wire:submit.prevent="update" class="space-y-5 bg-white p-6 rounded-lg shadow">
                <!-- Nama Kelas -->
                <div>
                    <label>Nama Kelas</label>
                    <input type="text" wire:model="nama_kelas" class="border p-2 w-full">
                    @error('nama_kelas')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Jurusan -->
                <!-- Jurusan -->
                <div>
                    <label class="block font-semibold text-gray-700 mb-1">Jurusan</label>
                    <select id="" wire:model="jurusan_id" class="border p-2 w-full rounded">
                        <option value="">-- Pilih Jurusan --</option>
                        @foreach ($jurusan_kelas as $jurusan)
                            <option value="{{ $jurusan->id }}">{{ $jurusan->nama_jurusan }}</option>
                        @endforeach
                    </select>
                    @error('jurusan')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Tingkat -->
                <div>
                    <label>Tingkat</label>
                    <select wire:model="tingkat" class="border p-2 w-full">
                        <option value="">Pilih Tingkat</option>
                        <option value="X">X</option>
                        <option value="XI">XI</option>
                        <option value="XII">XII</option>
                    </select>
                    @error('tingkat')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Tahun Ajaran -->
                <div>
                    <label for="tahun_ajaran" class="block mb-1">Tahun Ajaran</label>
                    <input type="number" id="tahun_ajaran" wire:model="tahun_ajaran" class="border rounded p-2 w-full"
                        placeholder="2025" min="1901" max="2155" step="1">
                    @error('tahun_ajaran')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Tombol -->
                <div class="flex gap-3">
                    <a href="{{ route('superadmin.siswa.kelas-siswa') }}"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                        Batal
                    </a>
                    <button type="submit" class="bg-[#0C356A] text-white px-4 py-2 rounded">
                        Edit Kelas
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
