<div>

    <!-- DETAIL PRESTASI -->
    <div class="max-w-7xl mx-auto p-6 mt-10">

        <!-- Back Button -->
        <a href="{{ route('list-prestasi') }}"
            class="inline-flex items-center mb-8 gap-2 px-6 mt-5 py-3.5 bg-[#0C356A] text-white font-semibold rounded-xl hover:bg-[#0a2b55] transform hover:scale-105 transition-all duration-300 shadow-md hover:shadow-xl">
            <i class='bx bx-arrow-back text-xl'></i>
            Semua Prestasi
        </a>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">

            <!-- Header Foto Siswa + Badge Jurusan -->
            <div class="relative">
                <img src="{{ $prestasi->siswa?->foto ? asset('storage/' . $prestasi->siswa->foto) : asset('images/default-avatar.jpg') }}"
                    alt="{{ $prestasi->siswa?->name }}" class="w-full h-[500px] object-contain">

                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>

                <!-- Info di atas foto -->
                <div class="absolute bottom-6 left-6 text-white">
                    <h1 class="text-4xl font-bold">{{ $prestasi->siswa?->name }}</h1>
                    <p class="text-xl mt-2 opacity-90">
                        {{ $prestasi->siswa?->kelas?->jurusan?->nama_jurusan ?? 'Jurusan Tidak Diketahui' }}
                    </p>
                </div>
            </div>

            <!-- Body Detail -->
            <div class="p-8 md:p-12">

                {{-- Judul Prestasi --}}
                <h2 class="text-3xl font-bold text-[#0C356A] mb-8">
                    {{ $prestasi->deskripsi }}
                </h2>

                {{-- Info Prestasi dalam 2 Kolom --}}
                <div class="rounded-xl p-6 border-l-4 border-[#FFC436] mb-10">
                    <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                        Informasi Prestasi
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-5">
                        <div>
                            <p class="text-sm text-gray-600 font-medium mb-1">Nama Siswa</p>
                            <p class="text-lg font-semibold text-gray-800">
                                {{ $prestasi->siswa?->name ?? '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600 font-medium mb-1">Jurusan</p>
                            <p class="text-lg font-semibold text-gray-800">
                                {{ $prestasi->siswa?->kelas?->jurusan?->nama_jurusan ?? '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600 font-medium mb-1">Kelas</p>
                            <p class="text-lg font-semibold text-gray-800">
                                {{ $prestasi->siswa?->kelas?->tingkat ?? '' }}
                                {{ $prestasi->siswa?->kelas?->nama_kelas ?? '' }}
                            </p>
                        </div>

                        @if ($prestasi->program)
                            <div>
                                <p class="text-sm text-gray-600 font-medium mb-1">Penyelenggara / Lomba</p>
                                <p class="text-lg font-semibold text-gray-800">
                                    {{ $prestasi->program->nama ?? ($prestasi->program->name ?? '-') }}
                                </p>
                            </div>
                        @endif

                        <div>
                            <p class="text-sm text-gray-600 font-medium mb-1">Tanggal Perolehan</p>
                            <p class="text-lg font-semibold text-gray-800">
                                {{ $prestasi->tanggal ? \Carbon\Carbon::parse($prestasi->tanggal)->format('d F Y') : 'Tidak tercatat' }}
                            </p>
                        </div>
                    </div>
                </div>

                <h2 class="text-2xl font-bold mb-3 text-[#0C356A]"><i class='bx bxs-camera text-[#0C356A]'></i> Dokumentasi: </h2>

                {{-- Foto Dokumentasi --}}
                <div>
                    @if ($prestasi->dokumentasi->count() > 0)
                        {{-- Loop semua dokumentasi --}}
                        @foreach ($prestasi->dokumentasi as $dok)
                            @php
                                // Decode JSON foto
                                $fotoArray = is_string($dok->foto)
                                    ? json_decode($dok->foto, true) ?? []
                                    : $dok->foto ?? [];
                            @endphp

                            {{-- Tampilkan semua foto dalam dokumentasi ini --}}
                            @if (!empty($fotoArray))
                                <div class="mb-10">
                                    {{-- Header Dokumentasi --}}
                                    <div class="mb-6">
                                        <h3 class="text-2xl font-bold text-gray-800 mb-2 flex items-center gap-2">
                                            <i class='bx bx-images text-[#FFC436] text-3xl'></i>
                                            {{ $dok->judul }}
                                        </h3>
                                        <p class="text-sm text-gray-600">
                                            <i class='bx bx-image-alt'></i>
                                            {{ count($fotoArray) }} foto dokumentasi
                                        </p>
                                    </div>

                                    {{-- Grid Foto (4 kolom) --}}
                                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                                        @foreach ($fotoArray as $fotoIndex => $foto)
                                            <div class="group relative bg-white rounded-xl shadow-md overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 cursor-pointer"
                                                onclick="openImageModal('{{ asset('storage/' . $foto) }}', '{{ $dok->judul }}')">

                                                {{-- Foto --}}
                                                <div class="aspect-square overflow-hidden bg-gray-100">
                                                    <img src="{{ asset('storage/' . $foto) }}"
                                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                                                        alt="{{ $dok->judul }} - Foto {{ $fotoIndex + 1 }}">
                                                </div>

                                                {{-- Overlay saat hover --}}
                                                <div
                                                    class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-300 flex items-center justify-center">
                                                    <i
                                                        class='bx bx-search-alt text-white text-5xl opacity-0 group-hover:opacity-100 transition-opacity duration-300'></i>
                                                </div>

                                                {{-- Overlay Info --}}
                                                <div
                                                    class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent p-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                    <p class="text-white text-sm font-medium truncate">
                                                        <i class='bx bx-image-alt'></i>
                                                        {{ basename($foto) }}
                                                    </p>
                                                    <p class="text-gray-300 text-xs mt-1">
                                                        Foto {{ $fotoIndex + 1 }} dari {{ count($fotoArray) }}
                                                    </p>
                                                </div>

                                                {{-- Number Badge --}}
                                                <div
                                                    class="absolute top-3 left-3 bg-[#0C356A] text-white rounded-full w-10 h-10 flex items-center justify-center text-sm font-bold shadow-lg">
                                                    {{ $fotoIndex + 1 }}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    {{-- Video jika ada --}}
                                    @if ($dok->video)
                                        <div class="mt-6 bg-blue-50 rounded-xl p-5 border-l-4 border-blue-500">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center gap-3">
                                                    <i class='bx bx-video text-3xl text-blue-600'></i>
                                                    <div>
                                                        <p class="text-sm font-semibold text-blue-900">Video Dokumentasi
                                                        </p>
                                                        <p class="text-xs text-blue-700 mt-1">Lihat video lengkap
                                                            dokumentasi</p>
                                                    </div>
                                                </div>
                                                <a href="{{ $dok->video }}" target="_blank"
                                                    class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold transition inline-flex items-center gap-2 shadow-md">
                                                    <i class='bx bx-link-external'></i>
                                                    Tonton Video
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    @else
                        <div
                            class="bg-gray-100 rounded-xl h-80 flex items-center justify-center border-2 border-dashed border-gray-300">
                            <div class="text-center">
                                <i class='bx bx-image text-6xl text-gray-400 mb-4'></i>
                                <p class="text-gray-500 font-medium text-lg">Belum ada foto dokumentasi</p>
                                <p class="text-gray-400 text-sm mt-2">Dokumentasi untuk prestasi ini akan segera
                                    ditambahkan</p>
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

    {{-- Modal Preview Gambar --}}
    <div id="imageModal" class="hidden fixed inset-0 bg-black bg-opacity-90 z-50 flex items-center justify-center p-4"
        onclick="closeImageModal()">
        <div class="relative max-w-7xl max-h-full" onclick="event.stopPropagation()">
            <button onclick="closeImageModal()"
                class="absolute -top-14 right-0 text-white hover:text-gray-300 transition">
                <i class='bx bx-x text-5xl'></i>
            </button>
            <img id="modalImage" src="" class="max-w-full max-h-[90vh] object-contain rounded-lg shadow-2xl">
            <p id="modalCaption" class="text-white text-center mt-4 font-medium text-lg"></p>
        </div>
    </div>

    {{-- Script untuk Modal --}}
    <script>
        function openImageModal(imageSrc, caption) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('modalCaption').textContent = caption;
            document.getElementById('imageModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Disable scroll
        }

        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.body.style.overflow = 'auto'; // Enable scroll
        }

        // Close modal dengan ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeImageModal();
            }
        });
    </script>

    <x-whatsapp />
    <x-footer />
</div>
