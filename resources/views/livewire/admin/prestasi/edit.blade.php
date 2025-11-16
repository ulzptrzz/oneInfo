<div class="flex min-h-screen">
    <x-sidebar />

    <div class="w-full mx-10 mt-10 bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="bg-[#0C356A] text-white p-6 flex justify-between items-center">
            <h2 class="text-2xl font-bold">Edit Prestasi</h2>
        </div>

        <div class="p-8">
            <form wire:submit.prevent="update" class="space-y-6">

                <!-- Input Tanggal -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Tanggal</label>
                    <input type="date" wire:model="tanggal"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0C356A]">
                    @error('tanggal') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Input Deskripsi -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
                    <textarea wire:model="deskripsi"
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0C356A]"
                              placeholder="Masukkan deskripsi prestasi"></textarea>
                    @error('deskripsi') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Pilih Siswa -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Siswa</label>
                    <select wire:model="siswa_id"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0C356A]">
                        <option value="">-- Pilih Siswa --</option>
                        @foreach($siswaList as $siswa)
                            <option value="{{ $siswa->id }}">{{ $siswa->name }}</option>
                        @endforeach
                    </select>
                    @error('siswa_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Pilih Program -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Program</label>
                    <select wire:model="program_id"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0C356A]">
                        <option value="">-- Pilih Program --</option>
                        @foreach($programList as $program)
                            <option value="{{ $program->id }}">{{ $program->name }}</option>
                        @endforeach
                    </select>
                    @error('program_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Pilih Dokumentasi -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Dokumentasi</label>
                    <select wire:model="dokumentasi_id"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0C356A]">
                        <option value="">-- Pilih Dokumentasi --</option>
                        @foreach($dokumentasiList as $dokumentasi)
                            <option value="{{ $dokumentasi->id }}">{{ $dokumentasi->judul }}</option>
                        @endforeach
                    </select>
                    @error('dokumentasi_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Button -->
                <div class="flex justify-end gap-3">
                    <a href="{{ route('admin.prestasi') }}"
                        class="bg-[#FFC436] text-[#0C356A] font-semibold px-4 py-2 rounded-lg hover:bg-yellow-600 transition">
                        Kembali
                    </a>
                    <div class="flex justify-end">
                        <button type="submit"
                                class="bg-[#0C356A] text-white font-semibold px-6 py-2 rounded-lg hover:bg-[#092b53] transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
