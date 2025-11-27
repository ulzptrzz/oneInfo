<div class="flex min-h-screen">
    <style>
        .drop-zone {
            transition: all 0.3s ease;
            border: 2px dashed #cbd5e1;
        }
        .drop-zone.drag-over {
            border-color: #FFC436;
            background-color: #fffbeb;
            transform: scale(1.02);
        }
        .drop-zone:hover {
            border-color: #FFC436;
            background-color: #fefce8;
        }
    </style>

    <aside class="fixed overflow-y-auto">
        <x-sidebar />
    </aside>

    <div class="flex-1 ml-64 mr-20 min-h-screen">
        <div class="w-full mx-8 my-7 bg-white rounded-2xl shadow-md overflow-hidden">
            <div class="bg-[#0C356A] text-white p-6">
                <h1 class="text-2xl font-bold">Tambah Dokumentasi</h1>
            </div>

            <div class="p-8">
                <form wire:submit.prevent="save" class="space-y-6">

                    <!-- Pilih Prestasi & Judul (sama kayak sebelumnya) -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Prestasi</label>
                        <select wire:model="prestasi_id" class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-[#FFC436] focus:outline-none transition">
                            <option value="">-- Pilih Prestasi --</option>
                            @foreach ($prestasis as $prestasi)
                                <option value="{{ $prestasi->id }}">
                                    {{ $prestasi->deskripsi }} @if($prestasi->siswa) @endif
                                </option>
                            @endforeach
                        </select>
                        @error('prestasi_id') <p class="text-red-600 text-sm mt-1"><i class='bx bx-error-circle'></i> {{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Dokumentasi</label>
                        <input type="text" wire:model="judul" placeholder="Contoh: Penyerahan Piala Juara 1" class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-[#FFC436] focus:outline-none transition" />
                        @error('judul') <p class="text-red-600 text-sm mt-1"><i class='bx bx-error-circle'></i> {{ $message }}</p> @enderror
                    </div>

                    <!-- FOTO UPLOAD - VERSI FINAL YANG BISA KLIK + DRAG & DROP MULTIPLE -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Foto Dokumentasi 
                        </label>

                        <!-- DROP ZONE + KLIK BUKA FILE MANAGER -->
                        <div class="drop-zone relative rounded-xl p-8 text-center cursor-pointer border-2 border-dashed bg-gray-50"
                            id="dropZone"
                            onclick="document.getElementById('fotoInput').click()">

                            <!-- Input file yang bener-bener dipake -->
                            <input type="file"
                                wire:model.live="newPhotos"
                                id="fotoInput"
                                multiple
                                accept="image/*"
                                class="hidden" />
                                
                            <!-- Tampilan awal -->
                            <div id="uploadPrompt">
                                <i class='bx bx-cloud-upload text-6xl text-gray-300 mb-4'></i>
                                <p class="text-lg font-semibold text-gray-700">Klik di sini atau Drag & Drop foto</p>
                                <p class="text-sm text-gray-500 mt-2">Bisa pilih banyak foto sekaligus (JPG, PNG, GIF - maks 3MB)</p>
                            </div>

                            <!-- Loading -->
                            <div wire:loading wire:target="newPhotos" 
                                class="absolute inset-0 bg-white bg-opacity-95 rounded-xl flex items-center justify-center z-10">
                                <div class="text-center">
                                    <div class="animate-spin rounded-full h-12 w-12 border-b-4 border-[#FFC436] mx-auto mb-4"></div>
                                    <p class="text-gray-700 font-medium">Mengunggah foto...</p>
                                </div>
                            </div>
                        </div>

                        <!-- PREVIEW FOTO YANG SUDAH DIPILIH -->
                        @if($foto && count($foto) > 0)
                            <div class="mt-6">
                                <p class="text-sm font-semibold text-gray-700 mb-3">
                                    Foto yang akan diupload ({{ count($foto) }} foto)
                                </p>
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                                    @foreach($foto as $index => $photo)
                                        <div class="relative group bg-white rounded-lg soverflow-hidden">

                                            <div class="w-full h-32 bg-green-100 rounded-lg flex items-center justify-center">
                                                <i class='bx bx-image text-3xl text-green-500'></i>
                                            </div>

                                            <!-- Tombol hapus -->
                                            <div class="absolute top-10 right-14 opacity-0 group-hover:opacity-100 transition">
                                                <button type="button" 
                                                        wire:click="removePhoto({{ $index }})"
                                                        class="bg-red-600 hover:bg-red-700 text-white rounded-full p-2 shadow-lg">
                                                    <i class='bx bx-trash text-xl'></i>
                                                </button>
                                            </div>

                                            <!-- Info file -->
                                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t rounded-lg from-black/60 to-transparent p-3">
                                                <p class="text-xs text-white font-medium truncate">
                                                    {{ Str::limit($photo->getClientOriginalName(), 20) }}
                                                </p>
                                                <p class="text-xs text-gray-300">
                                                    {{ number_format($photo->getSize() / 1024, 1) }} KB
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Error -->
                        @error('foto') 
                            <p class="text-red-600 text-sm mt-3 flex items-center gap-1">
                                <i class='bx bx-error-circle'></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Video URL & Tombol -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Video URL <span class="text-gray-400 text-xs">(Opsional)</span></label>
                        <input type="text" wire:model="video" placeholder="https://youtube.com/watch?v=..." class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-[#FFC436] focus:outline-none transition" />
                    </div>

                    <div class="flex justify-end gap-3 pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.dokumentasi') }}" class="px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition">
                            Kembali
                        </a>
                        <button type="submit" wire:loading.attr="disabled" class="px-8 py-3 bg-[#FFC436] text-[#0C356A] font-bold rounded-lg hover:bg-yellow-400 transition disabled:opacity-50">
                            <span wire:loading.remove wire:target="save">Simpan</span>
                            <span wire:loading wire:target="save">Menyimpan...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- SCRIPT DRAG & DROP YANG BARU (PASTI JALAN) -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const dropZone = document.getElementById('dropZone');
                const fileInput = document.getElementById('fotoInput');

                ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(event => {
                    dropZone.addEventListener(event, e => {
                        e.preventDefault();
                        e.stopPropagation();
                    });
                });

                ['dragenter', 'dragover'].forEach(event => {
                    dropZone.addEventListener(event, () => dropZone.classList.add('drag-over'));
                });

                ['dragleave', 'drop'].forEach(event => {
                    dropZone.addEventListener(event, () => dropZone.classList.remove('drag-over'));
                });

                dropZone.addEventListener('drop', e => {
                    const files = Array.from(e.dataTransfer.files);
                    if (files.length > 0) {
                        const dt = new DataTransfer();
                        files.forEach(f => dt.items.add(f));
                        fileInput.files = dt.files;
                        fileInput.dispatchEvent(new Event('change', { bubbles: true }));
                    }
                });
            });
        </script>
    </div>
</div>