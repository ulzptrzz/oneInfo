<div class="flex min-h-screen">
    <x-sidebar />

    <div class="w-full mx-10 mt-10 bg-white rounded-2xl shadow-md p-8">
        <h2 class="text-2xl font-bold text-[#0C356A] mb-6">Tambah Prestasi</h2>

        <form wire:submit.prevent="save" class="space-y-5">
            <div>
                <label class="block font-semibold mb-2">Tanggal</label>
                <input type="date" wire:model="tanggal" class="w-full border rounded-lg px-3 py-2" />
                @error('tanggal') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block font-semibold mb-2">Deskripsi</label>
                <textarea wire:model="deskripsi" class="w-full border rounded-lg px-3 py-2"></textarea>
                @error('deskripsi') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block font-semibold mb-2">Siswa</label>
                <select wire:model="siswa_id" class="w-full border rounded-lg px-3 py-2">
                    <option value="">-- Pilih Siswa --</option>
                    @foreach ($siswa as $s)
                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                    @endforeach
                </select>
                @error('siswa_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block font-semibold mb-2">Program</label>
                <select wire:model="program_id" class="w-full border rounded-lg px-3 py-2">
                    <option value="">-- Pilih Program --</option>
                    @foreach ($program as $p)
                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                    @endforeach
                </select>
                @error('program_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block font-semibold mb-2">Dokumentasi</label>
                <select wire:model="dokumentasi_id" class="w-full border rounded-lg px-3 py-2">
                    <option value="">-- Pilih Dokumentasi --</option>
                    @foreach ($dokumentasi as $d)
                        <option value="{{ $d->id }}">{{ $d->judul }}</option>
                    @endforeach
                </select>
                @error('dokumentasi_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.prestasi') }}"
                class="bg-[#FFC436] text-[#0C356A] font-semibold px-4 py-2 rounded-lg hover:bg-yellow-600 transition">
                Kembali
                </a>

                <button type="submit"
                        class="bg-[#0C356A] text-white px-6 py-2 rounded-lg hover:bg-[#092B58] transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
