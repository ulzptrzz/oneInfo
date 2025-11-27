<div class="flex min-h-screen">

    <aside class="fixed overflow-y-auto">
        <x-sidebar />
    </aside>

    {{-- KONTEN UTAMA --}}
    <div class="flex-1 ml-64 mr-20 min-h-screen">
        <div class="w-full mx-8 my-7 bg-white rounded-2xl shadow-md overflow-hidden">
            
            {{-- Header --}}
            <div class="bg-[#0C356A] text-white p-6">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-bold flex items-center gap-2">
                        Detail Dokumentasi
                    </h1>
                    <a href="{{ route('admin.dokumentasi') }}" 
                        class="px-4 py-2 bg-white text-[#0C356A] rounded-lg hover:bg-gray-100 transition font-semibold inline-flex items-center gap-2">
                        <i class='bx bx-arrow-back'></i>
                        Kembali
                    </a>
                </div>
            </div>

            {{-- Content --}}
            <div class="p-8 space-y-8">
                
                {{-- Info Prestasi --}}
                <div class="bg-gradient-to-r from-blue-50 to-yellow-50 rounded-xl p-6 border-l-4 border-[#FFC436]">
                    <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class='bx bx-trophy text-[#FFC436] text-2xl'></i>
                        Informasi Prestasi
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Id Siswa</p>
                            <p class="font-semibold text-gray-800">
                                {{ $dokumentasi->prestasi->siswa->id ?? '-' }}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Deskripsi Prestasi</p>
                            <p class="font-semibold text-gray-800">
                                {{ $dokumentasi->prestasi->deskripsi ?? '-' }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Judul Dokumentasi --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-2">
                        Judul Dokumentasi
                    </label>
                    <div class="bg-gray-50 rounded-lg p-4 border-2 border-gray-200">
                        <p class="text-lg font-bold text-gray-800">{{ $dokumentasi->judul }}</p>
                    </div>
                </div>

                {{-- Foto Dokumentasi --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-4">
                        Foto Dokumentasi
                        <span class="text-gray-400 font-normal">({{ count($foto) }} foto)</span>
                    </label>
                    
                    @if ($foto && count($foto) > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @foreach ($foto as $index => $path)
                                <div class="group relative bg-white rounded-xl shadow-md overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                                    
                                    {{-- Foto --}}
                                    <div class="aspect-square overflow-hidden bg-gray-100">
                                        <img src="{{ asset('storage/' . $path) }}" 
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                                            alt="Foto {{ $index + 1 }}">
                                    </div>

                                    {{-- Overlay Info --}}
                                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent p-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <p class="text-white text-sm font-medium truncate">
                                            <i class='bx bx-image-alt'></i>
                                            {{ basename($path) }}
                                        </p>
                                        <p class="text-gray-300 text-xs mt-1">
                                            Foto {{ $index + 1 }} dari {{ count($foto) }}
                                        </p>
                                    </div>

                                    {{-- Button Preview --}}
                                    <div class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <button onclick="openImageModal('{{ asset('storage/' . $path) }}')" 
                                            class="bg-white hover:bg-[#FFC436] text-gray-800 rounded-full p-2 shadow-lg transition">
                                            <i class='bx bx-show text-xl'></i>
                                        </button>
                                    </div>

                                    {{-- Number Badge --}}
                                    <div class="absolute top-3 left-3 bg-[#0C356A] text-white rounded-full w-8 h-8 flex items-center justify-center text-sm font-bold shadow-lg">
                                        {{ $index + 1 }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-gray-50 rounded-lg p-12 text-center border-2 border-dashed border-gray-300">
                            <i class='bx bx-image-alt text-6xl text-gray-400 mb-4'></i>
                            <p class="text-gray-500 font-medium">Tidak ada foto dokumentasi</p>
                        </div>
                    @endif
                </div>

                {{-- Video URL --}}
                @if ($dokumentasi->video)
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-2">
                            Video Dokumentasi
                        </label>
                        <div class="bg-gray-50 rounded-lg p-4 border-2 border-gray-200">
                            <div class="flex items-center gap-3">
                                <i class='bx bx-video text-2xl text-[#FFC436]'></i>
                                <a href="{{ $dokumentasi->video }}" 
                                    target="_blank"
                                    class="text-blue-600 hover:text-blue-800 font-medium hover:underline break-all">
                                    {{ $dokumentasi->video }}
                                </a>
                                <a href="{{ $dokumentasi->video }}" 
                                    target="_blank"
                                    class="ml-auto px-4 py-2 bg-[#FFC436] hover:bg-yellow-400 text-[#0C356A] rounded-lg font-semibold transition inline-flex items-center gap-2 whitespace-nowrap">
                                    <i class='bx bx-link-external'></i>
                                    Buka Video
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Action Buttons --}}
                <div class="flex flex-col sm:flex-row justify-between gap-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.dokumentasi') }}" 
                        class="px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition text-center inline-flex items-center justify-center gap-2">
                        Kembali
                    </a>
                    <a href="{{ route('edit-dokumentasi', $dokumentasi->id) }}" 
                        class="px-6 py-3 bg-[#FFC436] text-[#0C356A] font-bold rounded-lg hover:bg-yellow-400 transition text-center inline-flex items-center justify-center gap-2">
                        <i class='bx bx-edit'></i>
                        Edit Dokumentasi
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Preview Image --}}
    <div id="imageModal" class="hidden fixed inset-0 bg-black bg-opacity-90 z-50 flex items-center justify-center p-4" onclick="closeImageModal()">
        <div class="relative max-w-7xl max-h-full">
            <button onclick="closeImageModal()" 
                class="absolute -top-12 right-0 text-white hover:text-gray-300 text-4xl font-bold">
                <i class='bx bx-x'></i>
            </button>
            <img id="modalImage" src="" class="max-w-full max-h-[90vh] object-contain rounded-lg shadow-2xl">
        </div>
    </div>

    {{-- Script untuk Modal --}}
    <script>
        function openImageModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imageModal').classList.remove('hidden');
        }

        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
        }

        // Close modal dengan ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeImageModal();
            }
        });
    </script>
</div>