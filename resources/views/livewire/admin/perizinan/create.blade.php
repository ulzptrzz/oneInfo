<div class="flex min-h-screen">
    <x-sidebar active="perizinan" />

    <div class="w-full mx-10 mt-10 bg-white rounded-2xl shadow-md overflow-hidden">
        {{-- Header --}}
        <div class="bg-gradient-to-r from-[#0C356A] to-[#1e40af] text-white p-6">
            <h1 class="text-2xl font-bold flex items-center gap-2">
                Tambah Perizinan
            </h1>
            <p class="text-sm text-blue-100 mt-1">Buat perizinan baru untuk program sekolah</p>
        </div>

        {{-- Form --}}
        <div class="p-8">
            <form wire:submit.prevent="save" class="space-y-6">
                
                {{-- Nama Program --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Program
                    </label>
                    <input 
                        type="text" 
                        wire:model="nama_program" 
                        placeholder="Contoh: Izin Mengikuti Olimpiade"
                        class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-[#FFC436] focus:outline-none transition" />
                    @error('nama_program') 
                        <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                            <i class='bx bx-error-circle'></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Kategori --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Kategori
                    </label>
                    <select 
                        wire:model="kategori_program_id" 
                        class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-[#FFC436] focus:outline-none transition">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategori_program as $kat)
                            <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                        @endforeach
                    </select>
                    @error('kategori_program_id') 
                        <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                            <i class='bx bx-error-circle'></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Deskripsi
                    </label>
                    <textarea 
                        wire:model="deskripsi" 
                        rows="4"
                        placeholder="Jelaskan perizinan ini..."
                        class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-[#FFC436] focus:outline-none transition resize-none"></textarea>
                    @error('deskripsi') 
                        <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                            <i class='bx bx-error-circle'></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Gambar Upload --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Gambar Perizinan
                    </label>
                    
                    <div class="flex items-center gap-4">
                        <input 
                            type="file" 
                            wire:model="gambar" 
                            accept="image/*"
                            id="gambarInput"
                            class="hidden" />
                        
                        <button 
                            type="button"
                            onclick="document.getElementById('gambarInput').click()"
                            class="bg-[#FFC436] text-[#0C356A] px-6 py-3 rounded-lg font-semibold hover:bg-yellow-400 transition">
                            Choose File
                        </button>

                        {{-- No file chosen (default) --}}
                        @if (!isset($gambar) || !$gambar)
                            <span class="text-gray-500 text-sm">No file chosen</span>
                        @endif

                        {{-- Preview inline --}}
                        @if (isset($gambar) && $gambar)
                            <div class="flex-1 flex items-center justify-between bg-green-50 border-2 border-green-200 rounded-lg px-4 py-2">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                                        <i class='bx bx-image text-white text-xl'></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-800">{{ $gambar->getClientOriginalName() }}</p>
                                        <p class="text-xs text-gray-500">{{ number_format($gambar->getSize() / 1024, 2) }} KB</p>
                                    </div>
                                </div>
                                <button 
                                    type="button"
                                    wire:click="$set('gambar', null)"
                                    class="text-red-500 hover:text-red-700">
                                    <i class='bx bx-trash text-xl'></i>
                                </button>
                            </div>
                        @endif
                    </div>

                    @error('gambar') 
                        <p class="text-red-600 text-sm mt-2 flex items-center gap-1">
                            <i class='bx bx-error-circle'></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Action Buttons --}}
                <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.perizinan') }}"
                        class="px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition text-center">
                        Kembali
                    </a>
                    <button 
                        type="submit" 
                        class="px-6 py-3 bg-[#FFC436] text-[#0C356A] font-bold rounded-lg hover:bg-yellow-400 transition inline-flex items-center justify-center gap-2">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>