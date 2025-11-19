<div class="flex min-h-screen">
    <x-sidebar active="program" />

    <div class="w-full mx-10 mt-10 bg-white rounded-2xl shadow-md overflow-hidden">
        {{-- Header --}}
        <div class="bg-gradient-to-right from-[#0C356A] to-[#1e40af] text-white p-6">
            <h1 class="text-2xl font-bold flex items-center gap-2">
                Edit Program
            </h1>
        </div>

        {{-- Form --}}
        <div class="p-8">
            <form wire:submit="update" enctype="multipart/form-data" class="space-y-6">

                {{-- Nama Program --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Program</label>
                    <input type="text" wire:model="name"
                        class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-[#FFC436]"
                        placeholder="Contoh: Lomba Karya Ilmiah">
                    @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Singkat</label>
                    <textarea wire:model="deskripsi" rows="4"
                        class="w-full h-20 border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-[#FFC436] resize-none"
                        placeholder="Jelaskan program ini..."></textarea>
                    @error('deskripsi') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Kategori Program --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori Program</label>
                    <select wire:model="kategori_program_id"
                        class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-[#FFC436]">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategori_program as $kat)
                        <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                        @endforeach
                    </select>
                    @error('kategori_program_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Tanggal --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Mulai</label>
                        <input type="date" wire:model="tanggal_mulai"
                            class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-[#FFC436]">
                        @error('tanggal_mulai') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Selesai</label>
                        <input type="date" wire:model="tanggal_selesai"
                            class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-[#FFC436]">
                        @error('tanggal_selesai') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Status & Tingkat --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                        <select wire:model="status"
                            class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-[#FFC436]">
                            <option value="">-- Pilih Status --</option>
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                            <option value="archived">Archived</option>
                        </select>
                        @error('status') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tingkat</label>
                        <select wire:model="tingkat"
                            class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-[#FFC436]">
                            <option value="">-- Pilih Tingkat --</option>
                            <option value="nasional">Nasional</option>
                            <option value="provinsi">Provinsi</option>
                            <option value="kota">Kota</option>
                        </select>
                        @error('tingkat') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Poster Program --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Poster Program</label>

                    {{-- Poster lama --}}
                    @if ($oldPoster && !$poster)
                    <div class="mb-4 bg-blue-50 border-2 border-blue-200 rounded-lg p-4">
                        <p class="text-sm font-medium text-gray-700 mb-3">Poster Saat Ini:</p>
                        <div class="flex items-center gap-4">
                            <img src="{{ asset('storage/' . $oldPoster) }}" class="w-32 h-40 object-cover rounded-lg">
                            <div class="text-sm text-gray-600">
                                <p class="font-medium">Poster saat ini</p>
                                <p class="text-xs text-gray-500">Upload baru untuk mengganti</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- Upload poster baru --}}
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        {{ $oldPoster ? 'Ganti Poster (Opsional)' : 'Upload Poster' }}
                    </label>

                    <div class="flex items-center gap-4">
                        <input type="file" accept="image/*" wire:model="poster" id="posterInput" class="hidden">

                        <button type="button" onclick="document.getElementById('posterInput').click()"
                            class="bg-[#FFC436] text-[#0C356A] px-6 py-3 rounded-lg font-semibold">
                            Choose File
                        </button>

                        @if (!$poster)
                        <span class="text-gray-500 text-sm">No file chosen</span>
                        @endif

                        @if ($poster)
                        <div
                            class="flex-1 flex items-center justify-between bg-green-50 border-2 border-green-200 rounded-lg px-4 py-2">
                            <div class="flex items-center gap-3">
                                <i class='bx bx-image text-green-600 text-xl'></i>
                                <div>
                                    <p class="text-sm font-semibold">{{ $poster->getClientOriginalName() }}</p>
                                    <p class="text-xs">{{ number_format($poster->getSize() / 1024, 2) }} KB</p>
                                </div>
                            </div>
                            <button type="button" wire:click="$set('poster', null)"
                                class="text-red-500 hover:text-red-700">
                                <i class='bx bx-trash text-xl'></i>
                            </button>
                        </div>
                        @endif
                    </div>

                    @error('poster') <p class="text-red-600 text-sm mt-2">{{ $message }}</p> @enderror
                </div>

                {{-- Penyelenggara & Mata Lomba (ARRAY) --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Penyelenggara --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Penyelenggara</label>
                        <input type="text" wire:model="penyelenggaraInput"
                            class="w-full border-2 border-gray-200 rounded-lg px-4 py-3">
                        <button type="button" wire:click="addPenyelenggara"
                            class="mt-2 bg-blue-100 text-blue-700 px-4 py-2 rounded-full">
                            + Tambah
                        </button>
                    </div>
                    <div class="mt-3 space-y-2">
                        @foreach ($penyelenggara as $i => $item)
                        <div class="flex justify-between items-center bg-blue-50 py-2 px-3 rounded-lg">
                            <span>{{ $item }}</span>
                            <button wire:click="removePenyelenggara({{ $i }})"
                                class="text-red-500 hover:text-red-700 text-sm">Hapus</button>
                        </div>
                        @endforeach
                    </div>

                    {{-- Mata Lomba --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Mata Lomba</label>
                        <input type="text" wire:model="mataLombaInput"
                            class="w-full border-2 border-gray-200 rounded-lg px-4 py-3">
                        <button type="button" wire:click="addMataLomba"
                            class="mt-2 bg-blue-100 text-blue-700 px-4 py-2 rounded-full">
                            + Tambah
                        </button>
                    </div>
                    <div class="mt-3 space-y-2">
                        @foreach ($mata_lomba as $i => $item)
                        <div class="flex justify-between items-center bg-blue-50 py-2 px-3 rounded-lg">
                            <span>{{ $item }}</span>
                            <button wire:click="removeMataLomba({{ $i }})"
                                class="text-red-500 hover:text-red-700 text-sm">Hapus</button>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Pelaksanaan --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Pelaksanaan</label>
                    <select wire:model="pelaksanaan"
                        class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-[#FFC436]">
                        <option value="">-- Pilih Pelaksanaan --</option>
                        <option value="online">Online</option>
                        <option value="offline">Offline</option>
                    </select>
                    @error('pelaksanaan') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Link Pendaftaran --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Link Pendaftaran (Opsional)</label>
                    <input type="text" wire:model="link_pendaftaran"
                        class="w-full border-2 border-gray-200 rounded-lg px-4 py-3"
                        placeholder="https://contoh.com/daftar">
                    @error('link_pendaftaran') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Panduan Lomba --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Panduan Lomba
                    </label>

                    @if ($panduan_lomba && !$panduan_file)
                    <p class="text-sm mb-2">
                        Panduan saat ini:
                        @if (Str::contains($panduan_lomba, ['http', 'https']))
                        <a href="{{ $panduan_lomba }}" target="_blank" class="text-blue-600 underline">Lihat Link</a>
                        @else
                        <a href="{{ asset('storage/' . $panduan_lomba) }}" target="_blank" class="text-blue-600 underline">Download File</a>
                        @endif
                    </p>
                    @endif

                    {{-- Input file --}}
                    <input type="file" wire:model="panduan_file" class="block mt-2">

                    {{-- Input link --}}
                    <input type="text" wire:model="panduan_link" placeholder="Atau masukkan link panduan"
                        class="w-full border mt-3 rounded-lg px-4 py-2" />

                    @error('panduan_file') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    @error('panduan_link') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>

                {{-- Actions --}}
                <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.program') }}"
                        class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-center">
                        Kembali
                    </a>
                    <button type="submit"
                        class="px-6 py-3 bg-[#FFC436] text-[#0C356A] font-bold rounded-lg hover:bg-yellow-400">
                        Update
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>