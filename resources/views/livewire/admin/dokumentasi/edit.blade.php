<div class="flex min-h-screen">

    <aside class="fixed overflow-y-auto">
        <x-sidebar />
    </aside>

    {{-- KONTEN UTAMA --}}
    <div class="flex-1 ml-64 mr-20 min-h-screen">
        <div class="w-full mx-8 my-7 bg-white rounded-2xl shadow-md overflow-hidden">
            {{-- Header --}}
            <div class="bg-[#0C356A]  text-white p-6">
                <h1 class="text-2xl font-bold flex items-center gap-2">
                    Edit Dokumentasi
                </h1>
            </div>

            {{-- Form --}}
            <div class="p-8">
                <form wire:submit.prevent="update" class="space-y-6">

                    {{-- Pilih Prestasi --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Pilih Prestasi
                        </label>
                        <select wire:model="prestasi_id"
                            class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-[#FFC436] focus:outline-none transition">
                            <option value="">-- Pilih Prestasi --</option>
                            @foreach ($prestasis as $prestasi)
                                <option value="{{ $prestasi->id }}">
                                    {{ $prestasi->deskripsi }}
                                    @if ($prestasi->siswa)
                                        {{ $prestasi->siswa->nama }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @error('prestasi_id')
                            <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                                <i class='bx bx-error-circle'></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Judul --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Judul Dokumentasi
                        </label>
                        <input type="text" wire:model="judul" placeholder="Contoh: Foto Penyerahan Piala Juara 1"
                            class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-[#FFC436] focus:outline-none transition" />
                        @error('judul')
                            <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                                <i class='bx bx-error-circle'></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Foto Current & Upload --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Foto Dokumentasi
                        </label>

                        {{-- Current Photo --}}
                        @if ($foto && count($foto) > 0)
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 mb-6">
                                @foreach ($foto as $index => $path)
                                    <div
                                        class="relative group bg-white rounded-xl shadow border overflow-hidden hover:shadow-xl transition">
                                        <img src="{{ asset('storage/' . $path) }}" class="w-full h-40 object-cover"
                                            alt="Foto dokumentasi">

                                        <div
                                            class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition flex items-center justify-center">
                                            <button type="button" wire:click="removeOldPhoto({{ $index }})"
                                                class="opacity-0 group-hover:opacity-100 bg-red-600 hover:bg-red-700 text-white rounded-full p-3 transition">
                                                <i class='bx bx-trash text-xl'></i>
                                            </button>
                                        </div>

                                        <div
                                            class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 p-2">
                                            <p class="text-xs text-white truncate">{{ basename($path) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        {{-- Upload New Photo --}}
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Ganti Foto <span class="text-gray-400 text-xs">(Opsional)</span>
                        </label>

                        <div class="relative">
                            <!-- Upload Foto Baru -->
                            <input type="file" wire:model="newPhotos" multiple accept="image/*"
                                class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-[#FFC436] file:text-[#0C356A] file:font-semibold hover:file:bg-yellow-400" />
                            {{-- Loading State --}}
                            <div wire:loading wire:target="newPhotos"
                                class="absolute inset-0 bg-white bg-opacity-90 rounded-lg flex items-center justify-center">
                                <div class="text-center">
                                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-[#FFC436] mx-auto">
                                    </div>
                                    <p class="text-xs text-gray-600 mt-2">Mengunggah...</p>
                                </div>
                            </div>
                        </div>

                        <p class="text-xs text-gray-500 mt-1 flex items-center gap-1">
                            <i class='bx bx-info-circle'></i>
                            Format: PNG, JPG, JPEG, GIF (Maks. 3MB)
                        </p>

                        {{-- Preview New Photo --}}
                        @if ($newPhotos)
                            <div class="relative group bg-white rounded-lg soverflow-hidden">

                                <div class="w-full h-32 bg-green-100 rounded-lg flex items-center justify-center">
                                    <i class='bx bx-image text-3xl text-green-500'></i>
                                </div>

                                <!-- Tombol hapus -->
                                <div class="absolute top-10 right-14 opacity-0 group-hover:opacity-100 transition">
                                    <button type="button" wire:click="removePhoto({{ $index }})"
                                        class="bg-red-600 hover:bg-red-700 text-white rounded-full p-2 shadow-lg">
                                        <i class='bx bx-trash text-xl'></i>
                                    </button>
                                </div>

                                <!-- Info file -->
                                <div
                                    class="absolute bottom-0 left-0 right-0 bg-gradient-to-t rounded-lg from-black/60 to-transparent p-3">
                                    <p class="text-xs text-white font-medium truncate">
                                        {{ Str::limit($photo->getClientOriginalName(), 20) }}
                                    </p>
                                    <p class="text-xs text-gray-300">
                                        {{ number_format($photo->getSize() / 1024, 1) }} KB
                                    </p>
                                </div>
                            </div>
                        @endif

                        @error('foto')
                            <p class="text-red-600 text-sm mt-2 flex items-center gap-1">
                                <i class='bx bx-error-circle'></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Video URL --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Video URL <span class="text-gray-400 text-xs">(Opsional)</span>
                        </label>
                        <div class="relative">
                            <input type="url" wire:model="video" placeholder="https://youtube.com/watch?v=..."
                                class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 pl-10 focus:border-[#FFC436] focus:outline-none transition" />
                            <i class='bx bx-link absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400'></i>
                        </div>
                        <p class="text-xs text-gray-500 mt-1 flex items-center gap-1">
                            <i class='bx bx-info-circle'></i>
                            Link YouTube, Vimeo, atau platform video lainnya
                        </p>
                        @error('video')
                            <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                                <i class='bx bx-error-circle'></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.dokumentasi') }}"
                            class="px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition text-center inline-flex items-center justify-center gap-2">
                            Kembali
                        </a>
                        <button type="submit" wire:loading.attr="disabled"
                            class="px-6 py-3 bg-[#FFC436] text-[#0C356A] font-bold rounded-lg hover:bg-yellow-400 transition inline-flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed">
                            <span wire:loading.remove wire:target="update">
                                Simpan
                            </span>
                            <span wire:loading wire:target="update">
                                <i class='bx bx-loader-alt animate-spin'></i>
                                Memperbarui...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
