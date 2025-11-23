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

        .preview-image {
            animation: fadeIn 0.3s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>

    <aside class="fixed overflow-y-auto">
        <x-sidebar active="program" />
    </aside>

    {{-- KONTEN UTAMA --}}
    <div class="flex-1 ml-64 mr-20 min-h-screen">
        <div class="w-full mx-8 my-7 bg-white rounded-2xl shadow-md overflow-hidden">

            {{-- Header --}}
            <div class="bg-[#0C356A]  text-white p-6">
                <h1 class="text-2xl font-bold flex items-center gap-2">
                    Tambah Dokumentasi
                </h1>
            </div>

            {{-- Form --}}
            <div class="p-8">
                <form wire:submit.prevent="save" class="space-y-6">

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
                                <{{ $message }} </p>
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

                    {{-- Foto Upload with Drag & Drop --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Foto Dokumentasi
                        </label>

                        {{-- Drop Zone --}}
                        <div class="drop-zone relative rounded-xl p-8 text-center cursor-pointer" id="dropZone"
                            onclick="document.getElementById('fotoInput').click()">

                            <input type="file" wire:model="foto" id="fotoInput"
                                accept="image/jpeg,image/png,image/jpg,image/gif" class="hidden" />

                            <div id="uploadPrompt">
                                <i class='bx bx-cloud-upload text-6xl text-gray-300 mb-3'></i>
                                <p class="text-gray-600 font-medium mb-1">Klik untuk pilih foto atau drag & drop</p>
                                <p class="text-sm text-gray-400">PNG, JPG, JPEG, GIF (Maks. 3MB)</p>
                            </div>

                            {{-- Loading State --}}
                            <div wire:loading wire:target="foto"
                                class="absolute inset-0 bg-white bg-opacity-90 rounded-xl flex items-center justify-center">
                                <div class="text-center">
                                    <div
                                        class="animate-spin rounded-full h-12 w-12 border-b-2 border-[#FFC436] mx-auto mb-3">
                                    </div>
                                    <p class="text-gray-600 font-medium">Mengunggah foto...</p>
                                </div>
                            </div>
                        </div>

                        {{-- Preview --}}
                        @if ($foto)
                            <div class="mt-4 bg-green-50 border-2 border-green-200 rounded-lg p-4 preview-image">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                                            <i class='bx bx-check text-white text-xl'></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-800">
                                                {{ $foto->getClientOriginalName() }}</p>
                                            <p class="text-xs text-gray-500">
                                                {{ number_format($foto->getSize() / 1024, 2) }} KB</p>
                                        </div>
                                    </div>
                                    <button type="button" wire:click="$set('foto', null)"
                                        class="text-red-500 hover:text-red-700 hover:bg-red-100 rounded-lg p-2 transition">
                                        <i class='bx bx-trash text-xl'></i>
                                    </button>
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
                            <input type="text" wire:model="video" placeholder="https://youtube.com/watch?v=..."
                                class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 pl-10 focus:border-[#FFC436] focus:outline-none transition" />
                            <i class='bx bx-link absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400'></i>
                        </div>
                        <p class="text-xs text-gray-500 mt-1 flex items-center gap-1">
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
                            <span wire:loading.remove wire:target="save">
                                Simpan
                            </span>
                            <span wire:loading wire:target="save">
                                <i class='bx bx-loader-alt animate-spin'></i>
                                Menyimpan...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Drag & Drop Script --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const dropZone = document.getElementById('dropZone');
                const fileInput = document.getElementById('fotoInput');

                if (!dropZone || !fileInput) return;

                // Prevent default drag behaviors
                ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                    dropZone.addEventListener(eventName, preventDefaults, false);
                    document.body.addEventListener(eventName, preventDefaults, false);
                });

                function preventDefaults(e) {
                    e.preventDefault();
                    e.stopPropagation();
                }

                // Highlight drop zone when item is dragged over it
                ['dragenter', 'dragover'].forEach(eventName => {
                    dropZone.addEventListener(eventName, highlight, false);
                });

                ['dragleave', 'drop'].forEach(eventName => {
                    dropZone.addEventListener(eventName, unhighlight, false);
                });

                function highlight(e) {
                    dropZone.classList.add('drag-over');
                }

                function unhighlight(e) {
                    dropZone.classList.remove('drag-over');
                }

                // Handle dropped files
                dropZone.addEventListener('drop', handleDrop, false);

                function handleDrop(e) {
                    const dt = e.dataTransfer;
                    const files = dt.files;

                    if (files.length > 0) {
                        const file = files[0];

                        // Validate file type
                        const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                        if (!validTypes.includes(file.type)) {
                            alert('Format file tidak didukung. Gunakan JPG, PNG, atau GIF.');
                            return;
                        }

                        // Validate file size (3MB)
                        if (file.size > 3 * 1024 * 1024) {
                            alert('Ukuran file maksimal 3MB.');
                            return;
                        }

                        // Set the file to the input
                        fileInput.files = files;

                        // Trigger Livewire update
                        const event = new Event('change', {
                            bubbles: true
                        });
                        fileInput.dispatchEvent(event);
                    }
                }
            });
        </script>
    </div>
</div>
