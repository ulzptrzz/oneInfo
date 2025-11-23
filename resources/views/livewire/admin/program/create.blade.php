<div class="flex min-h-screen bg-gray-50">
    <x-sidebar active="program" />

    <!-- MAIN CONTENT -->
    <div class="flex-1 p-6 lg:p-10">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            {{-- Header Biru Gradient --}}
            <div class="bg-gradient-to-r from-[#0C356A] to-[#1e40af] text-white p-8">
                <h1 class="text-3xl font-bold flex items-center gap-3">
                    Tambah Program
                </h1>
            </div>


            {{-- Form --}}
            <div class="p-8">
                <form wire:submit="save" enctype="multipart/form-data" class="space-y-6">

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
                            Deskripsi
                        </label>
                        <textarea
                            wire:model="deskripsi"
                            rows="4"
                            placeholder="Jelaskan program ini..."
                            class="w-full h-20 border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-[#FFC436] focus:outline-none transition resize-none"></textarea>
                        @error('deskripsi')
                        <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                            <i class='bx bx-error-circle'></i> {{ $message }}
                        </p>
                        @enderror
                    </div>

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
                                <option value="sekolah">Sekolah</option>
                                <option value="kecamatan">Kecamatan</option>
                                <option value="kota">Kota</option>
                                <option value="provinsi">Provinsi</option>
                                <option value="nasional">Nasional</option>
                                <option value="regional">Regional</option>
                                <option value="internasional">Internasional</option>
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

                            @if ($poster)
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


                            @error('poster')
                            <p class="text-red-600 text-sm mt-2 flex items-center gap-1">
                                <i class='bx bx-error-circle'></i> {{ $message }}
                            </p>
                            @enderror
                        </div>

                        {{-- Penyelenggara & Mata Lomba --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                            {{-- Penyelenggara --}}
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-3">
                                    Penyelenggara
                                </label>

                                <div class="flex items-center gap-3">
                                    <input type="text" wire:model="penyelenggaraInput"
                                        class="flex-1 border-2 border-gray-200 rounded-lg px-4 py-3 focus:ring focus:ring-blue-200">
                                    <button type="button"
                                        wire:click="addPenyelenggara"
                                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                                        + Tambah
                                    </button>
                                </div>

                                <div class="mt-4 space-y-2">
                                    @foreach ($penyelenggara as $index => $item)
                                    <div class="flex justify-between items-center bg-blue-50 py-2 px-3 rounded-lg">
                                        <span>{{ $item }}</span>
                                        <button type="button" wire:click="removePenyelenggara({{ $index }})"
                                            class="text-red-500 hover:text-red-700 text-sm">
                                            Hapus
                                        </button>
                                    </div>
                                    @endforeach
                                </div>
                                @error('penyelenggara')
                                <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                                    <i class='bx bx-error-circle'></i> {{ $message }}
                                </p>
                                @enderror
                            </div>

                            {{-- Mata Lomba --}}
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-3">
                                    Mata Lomba
                                </label>

                                <div class="flex items-center gap-3">
                                    <input type="text" wire:model="mataLombaInput"
                                        class="flex-1 border-2 border-gray-200 rounded-lg px-4 py-3 focus:ring focus:ring-blue-200">
                                    <button type="button"
                                        wire:click="addMataLomba"
                                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                                        + Tambah
                                    </button>
                                </div>

                                <div class="mt-4 space-y-2">
                                    @foreach ($mata_lomba as $index => $item)
                                    <div class="flex justify-between items-center bg-blue-50 py-2 px-3 rounded-lg">
                                        <span>{{ $item }}</span>
                                        <button type="button" wire:click="removeMataLomba({{ $index }})"
                                            class="text-red-500 hover:text-red-700 text-sm">
                                            Hapus
                                        </button>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Pelaksanaan
                            </label>
                            <select
                                wire:model="pelaksanaan"
                                class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-[#FFC436] focus:outline-none transition">
                                <option value="">-- Pilih Pelaksanaan --</option>
                                <option value="online">Online</option>
                                <option value="offline">Offline</option>
                            </select>
                            @error('pelaksanaan')
                            <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                                <i class='bx bx-error-circle'></i> {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Link Pendaftaran (Opsional)</label>
                            <input
                                type="text"
                                wire:model="link_pendaftaran"
                                placeholder="https://contoh.com/daftar"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                            @error('link_pendaftaran')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <h2 class="font-bold text-lg text-gray-700 mb-3">Panduan Lomba</h2>

                            <label class="block text-sm font-semibold mb-2">Upload PDF atau Masukkan Link</label>

                            <div class="space-y-3">

                                {{-- Upload PDF --}}
                                <div>
                                    <input type="file" wire:model="panduan_file" accept="application/pdf"
                                        class="w-full border-2 border-gray-200 rounded-lg px-4 py-3">
                                    @error('panduan_file') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                                </div>

                                {{-- Link --}}
                                <div>
                                    <input type="text" wire:model.lazy="panduan_link" placeholder="https://example.com/panduan"
                                        class="w-full border-2 border-gray-200 rounded-lg px-4 py-3">
                                    @error('panduan_link') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>
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