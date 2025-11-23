<div class="flex min-h-screen">

    <aside class="fixed overflow-y-auto">
        <x-sidebar  />
    </aside>

    {{-- KONTEN UTAMA --}}
    <div class="flex-1 ml-64 mr-20 min-h-screen">
        <div class="w-full mx-8 my-7 bg-white rounded-2xl shadow-md overflow-hidden">

            {{-- HEADER --}}
            <div class="bg-[#0C356A] text-white p-6">
                <h1 class="text-2xl font-bold flex items-center gap-2">
                    Tambah Prestasi
                </h1>
            </div>

            {{-- FORM --}}
            <div class="p-8">
                <form wire:submit.prevent="save" class="space-y-6">

                    {{-- Tanggal --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal</label>
                        <input type="date" wire:model="tanggal"
                            class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 
                               focus:border-[#FFC436] focus:outline-none transition">
                        @error('tanggal')
                            <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                                <i class='bx bx-error-circle'></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                        <textarea wire:model="deskripsi" placeholder="Contoh: Juara 1 Lomba Cerdas Cermat Tingkat Kota" rows="4"
                            class="w-full h-20 border-2 border-gray-200 rounded-lg px-4 py-3 resize-none
                               focus:border-[#FFC436] focus:outline-none transition">
                    </textarea>
                        @error('deskripsi')
                            <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                                <i class='bx bx-error-circle'></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Siswa --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Siswa</label>
                        <select wire:model="siswa_id"
                            class="w-full border-2 border-gray-200 rounded-lg px-4 py-3
                               focus:border-[#FFC436] focus:outline-none transition">
                            <option value="">-- Pilih Siswa --</option>
                            @foreach ($siswa as $s)
                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                            @endforeach
                        </select>
                        @error('siswa_id')
                            <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                                <i class='bx bx-error-circle'></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Program --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Program</label>
                        <select wire:model="program_id"
                            class="w-full border-2 border-gray-200 rounded-lg px-4 py-3
                               focus:border-[#FFC436] focus:outline-none transition">
                            <option value="">-- Pilih Program --</option>
                            @foreach ($program as $p)
                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                            @endforeach
                        </select>
                        @error('program_id')
                            <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                                <i class='bx bx-error-circle'></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- BUTTONS --}}
                    <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.prestasi') }}"
                            class="px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold 
                               rounded-lg hover:bg-gray-50 transition text-center">
                            Kembali
                        </a>

                        <button type="submit"
                            class="px-6 py-3 bg-[#FFC436] text-[#0C356A] font-bold rounded-lg 
                               hover:bg-yellow-400 transition inline-flex items-center justify-center gap-2">
                            Simpan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
