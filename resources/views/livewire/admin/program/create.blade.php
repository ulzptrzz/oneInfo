<div class="flex min-h-screen">
    <x-sidebar active="program" />

    <div class="w-full mx-10 mt-10 bg-white rounded-2xl shadow-md overflow-hidden">
        {{-- Header --}}
        <div class="bg-gradient-to-r from-[#0C356A] to-[#1e40af] text-white p-6">
            <h1 class="text-2xl font-bold flex items-center gap-2">
                Tambah Program
            </h1>
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
                        wire:model="name" 
                        placeholder="Contoh: Lomba Karya Ilmiah"
                        class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-[#FFC436] focus:outline-none transition" />
                    @error('name') 
                        <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                            <i class='bx bx-error-circle'></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Deskripsi Singkat
                    </label>
                    <textarea 
                        wire:model="deskripsi_singkat" 
                        rows="4"
                        placeholder="Jelaskan program ini..."
                        class="w-full h-20 border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-[#FFC436] focus:outline-none transition resize-none"></textarea>
                    @error('deskripsi_singkat') 
                        <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                            <i class='bx bx-error-circle'></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Tanggal --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Tanggal Mulai
                        </label>
                        <input 
                            type="date" 
                            wire:model="tanggal_mulai" 
                            class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-[#FFC436] focus:outline-none transition" />
                        @error('tanggal_mulai') 
                            <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                                <i class='bx bx-error-circle'></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Tanggal Selesai
                        </label>
                        <input 
                            type="date" 
                            wire:model="tanggal_selesai" 
                            class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-[#FFC436] focus:outline-none transition" />
                        @error('tanggal_selesai') 
                            <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                                <i class='bx bx-error-circle'></i> {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                {{-- Status & Tingkat --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Status
                        </label>
                        <select 
                            wire:model="status" 
                            class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-[#FFC436] focus:outline-none transition">
                            <option value="">-- Pilih Status --</option>
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                            <option value="archived">Archived</option>
                        </select>
                        @error('status') 
                            <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                                <i class='bx bx-error-circle'></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Tingkat
                        </label>
                        <select 
                            wire:model="tingkat" 
                            class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-[#FFC436] focus:outline-none transition">
                            <option value="">-- Pilih Tingkat --</option>
                            <option value="nasional">Nasional</option>
                            <option value="provinsi">Provinsi</option>
                            <option value="kota">Kota</option>
                        </select>
                        @error('tingkat') 
                            <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                                <i class='bx bx-error-circle'></i> {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                {{-- Poster Upload --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Poster Program
                    </label>
                    
                    <div class="flex items-center gap-4">
                        <input 
                            type="file" 
                            wire:model="poster" 
                            accept="image/*"
                            id="posterInput"
                            class="hidden" />
                        
                        <button 
                            type="button"
                            onclick="document.getElementById('posterInput').click()"
                            class="bg-[#FFC436] text-[#0C356A] px-6 py-3 rounded-lg font-semibold hover:bg-yellow-400 transition">
                            Choose File
                        </button>

                        {{-- No file chosen (default) --}}
                        @if (!$poster)
                            <span class="text-gray-500 text-sm">No file chosen</span>
                        @endif

                        {{-- Preview inline (jika 1 file) --}}
                        @if ($poster && !is_array($poster))
                            <div class="flex-1 flex items-center justify-between bg-green-50 border-2 border-green-200 rounded-lg px-4 py-2">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                                        <i class='bx bx-image text-white text-xl'></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-800">{{ $poster->getClientOriginalName() }}</p>
                                        <p class="text-xs text-gray-500">{{ number_format($poster->getSize() / 1024, 2) }} KB</p>
                                    </div>
                                </div>
                                <button 
                                    type="button"
                                    wire:click="$set('poster', null)"
                                    class="text-red-500 hover:text-red-700">
                                    <i class='bx bx-trash text-xl'></i>
                                </button>
                            </div>
                        @endif
                    </div>

                    {{-- Preview list (jika lebih dari 1 file) --}}
                    @if ($poster && is_array($poster) && count($poster) > 1)
                        <div class="mt-4 space-y-2">
                            @foreach($poster as $index => $file)
                                <div class="bg-green-50 border-2 border-green-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                                                <i class='bx bx-image text-white text-xl'></i>
                                            </div>
                                            <div>
                                                <p class="text-sm font-semibold text-gray-800">{{ $file->getClientOriginalName() }}</p>
                                                <p class="text-xs text-gray-500">{{ number_format($file->getSize() / 1024, 2) }} KB</p>
                                            </div>
                                        </div>
                                        <button 
                                            type="button"
                                            wire:click="removeFile({{ $index }})"
                                            class="text-red-500 hover:text-red-700 hover:bg-red-100 rounded-lg p-2 transition">
                                            <i class='bx bx-trash text-xl'></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    @error('poster') 
                        <p class="text-red-600 text-sm mt-2 flex items-center gap-1">
                            <i class='bx bx-error-circle'></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Penyelenggara & Mata Lomba --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Penyelenggara
                        </label>
                        <input 
                            type="text" 
                            wire:model="penyelenggara" 
                            placeholder="Contoh: Kemendikbud"
                            class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-[#FFC436] focus:outline-none transition" />
                        @error('penyelenggara') 
                            <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                                <i class='bx bx-error-circle'></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Mata Lomba
                        </label>
                        <input 
                            type="text" 
                            wire:model="mata_lomba" 
                            placeholder="Contoh: Fisika"
                            class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-[#FFC436] focus:outline-none transition" />
                        @error('mata_lomba') 
                            <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                                <i class='bx bx-error-circle'></i> {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                {{-- Kategori --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Kategori Program
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

                {{-- Action Buttons --}}
                <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.program') }}"
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