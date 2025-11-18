<div class="flex min-h-screen">
    <x-sidebar />

    <div class="w-full mx-10 mt-10 bg-white rounded-2xl shadow-md overflow-hidden">

        {{-- Header --}}
        <div class="bg-gradient-to-r from-[#0C356A] to-[#1e40af] text-white p-6">
            <h1 class="text-2xl font-bold flex items-center gap-2">
                <i class='bx bx-news text-2xl'></i>
                Tambah Artikel
            </h1>
        </div>

        {{-- Form --}}
        <div class="p-8">
            @if (session()->has('message'))
                <div class="bg-green-100 text-green-800 px-4 py-3 rounded-lg mb-4 border border-green-300">
                    {{ session('message') }}
                </div>
            @endif

            <form wire:submit.prevent="save" class="space-y-6">

                {{-- Judul --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Artikel</label>
                    <input 
                        type="text" 
                        wire:model="judul"
                        class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-[#FFC436] focus:outline-none transition"
                        placeholder="Contoh: Pentingnya Literasi Digital"
                    >
                    @error('judul')
                        <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                            <i class='bx bx-error-circle'></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                    <textarea 
                        wire:model="deskripsi"
                        rows="5"
                        placeholder="Tulis deskripsi artikel..."
                        class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-[#FFC436] focus:outline-none transition resize-none"
                    ></textarea>
                    @error('deskripsi')
                        <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                            <i class='bx bx-error-circle'></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Status --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                    <select 
                        wire:model="status"
                        class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-[#FFC436] focus:outline-none transition"
                    >
                        <option value="">-- Pilih Status --</option>
                        <option value="draft">Draft</option>
                        <option value="publised">Published</option>
                        <option value="archived">Archived</option>
                    </select>
                    @error('status')
                        <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                            <i class='bx bx-error-circle'></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Tanggal --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Artikel</label>
                    <input 
                        type="date" 
                        wire:model="tanggal"
                        class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-[#FFC436] focus:outline-none transition"
                    >
                    @error('tanggal')
                        <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                            <i class='bx bx-error-circle'></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Thumbnail Upload --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Thumbnail Artikel</label>

                    <div class="flex items-center gap-4">
                        <input 
                            type="file" 
                            wire:model="thumbnail"
                            accept="image/*"
                            id="thumbInput"
                            class="hidden"
                        >

                        <button 
                            type="button"
                            onclick="document.getElementById('thumbInput').click()"
                            class="bg-[#FFC436] text-[#0C356A] px-6 py-3 rounded-lg font-semibold hover:bg-yellow-400 transition"
                        >
                            Choose File
                        </button>

                        @if (!$thumbnail)
                            <span class="text-gray-500 text-sm">No file chosen</span>
                        @endif

                        @if ($thumbnail)
                            <div class="flex-1 flex items-center justify-between bg-green-50 border-2 border-green-200 rounded-lg px-4 py-2">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                                        <i class='bx bx-image text-white text-xl'></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-800">{{ $thumbnail->getClientOriginalName() }}</p>
                                        <p class="text-xs text-gray-500">{{ number_format($thumbnail->getSize() / 1024, 2) }} KB</p>
                                    </div>
                                </div>
                                <button 
                                    type="button"
                                    wire:click="$set('thumbnail', null)"
                                    class="text-red-500 hover:text-red-700"
                                >
                                    <i class='bx bx-trash text-xl'></i>
                                </button>
                            </div>
                        @endif
                    </div>

                    @error('thumbnail')
                        <p class="text-red-600 text-sm mt-2 flex items-center gap-1">
                            <i class='bx bx-error-circle'></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Action Buttons --}}
                <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.artikel') }}"
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
