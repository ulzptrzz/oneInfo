<div class="flex min-h-screen">
    <x-sidebar active="dokumentasi" />

    <div class="w-full mx-10 mt-10 bg-white rounded-2xl shadow-md overflow-hidden">
        {{-- Header --}}
        <div class="bg-gradient-to-r from-[#0C356A] to-[#1e40af] text-white p-6">
            <h1 class="text-2xl font-bold flex items-center gap-2">
                Edit Dokumentasi
            </h1>
            <p class="text-sm text-blue-100 mt-1">Perbarui foto dan video dokumentasi kegiatan sekolah</p>
        </div>

        {{-- Form --}}
        <div class="p-8">
            <form wire:submit.prevent="update" enctype="multipart/form-data" class="space-y-6">
                
                {{-- Judul --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Judul Dokumentasi
                    </label>
                    <input 
                        type="text" 
                        wire:model="judul" 
                        placeholder="Contoh: Kegiatan Upacara Bendera"
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
                    @if ($oldFoto)
                        <div class="mb-4 bg-blue-50 border-2 border-blue-200 rounded-lg p-4">
                            <p class="text-sm font-medium text-gray-700 mb-3">Foto Saat Ini:</p>
                            <div class="flex items-center gap-4">
                                <img src="{{ asset('storage/' . $oldFoto) }}" 
                                     alt="Current Photo" 
                                     class="w-32 h-32 object-cover rounded-lg border-2 border-gray-300">
                                <div class="text-sm text-gray-600">
                                    <p class="font-medium">Foto yang sedang digunakan</p>
                                    <p class="text-xs text-gray-500 mt-1">Upload foto baru untuk mengganti</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="mb-4 bg-gray-50 border-2 border-gray-200 rounded-lg p-4">
                            <p class="text-gray-500 text-sm italic">Belum ada foto yang diupload</p>
                        </div>
                    @endif

                    {{-- Upload New Photo --}}
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Ganti Foto (Opsional)
                    </label>
                    
                    <div class="relative">
                        <input 
                            type="file" 
                            wire:model="foto" 
                            id="fotoInput"
                            accept="image/*"
                            class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-[#FFC436] focus:outline-none transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-[#FFC436] file:text-[#0C356A] file:font-semibold hover:file:bg-yellow-400 file:cursor-pointer" />
                        
                        {{-- Loading State --}}
                        <div wire:loading wire:target="foto" class="absolute inset-0 bg-white bg-opacity-90 rounded-lg flex items-center justify-center">
                            <div class="text-center">
                                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-[#FFC436] mx-auto"></div>
                            </div>
                        </div>
                    </div>

                    {{-- Preview New Photo --}}
                    @if ($foto)
                        <div class="mt-4 bg-green-50 border-2 border-green-200 rounded-lg p-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                                        <i class='bx bx-check text-white text-xl'></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-800">{{ $foto->getClientOriginalName() }}</p>
                                        <p class="text-xs text-gray-500">{{ number_format($foto->getSize() / 1024, 2) }} KB</p>
                                    </div>
                                </div>
                                <button 
                                    type="button"
                                    wire:click="$set('foto', null)"
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
                        Video URL (Opsional)
                    </label>
                    <div class="relative">
                        <input 
                            type="url" 
                            wire:model="video" 
                            placeholder="https://youtube.com/watch?v=..."
                            class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 pl-10 focus:border-[#FFC436] focus:outline-none transition" />
                        <i class='bx bx-link absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400'></i>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Link YouTube, Vimeo, atau platform video lainnya</p>
                    @error('video') 
                        <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                            <i class='bx bx-error-circle'></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Action Buttons --}}
                <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.dokumentasi') }}"
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