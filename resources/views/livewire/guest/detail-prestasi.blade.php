<div>
    <x-navbar />

    <!-- DETAIL PRESTASI -->
    <div class="max-w-5xl mx-auto p-6 mt-10">

        <!-- Back Button -->
        <a href="{{ route('list-prestasi') }}"
           class="inline-flex items-center gap-2 text-[#0C356A] hover:text-[#ffc436] font-medium mb-8 transition">
            <i class='bx bx-arrow-back text-xl'></i>
            Semua Prestasi
        </a>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">

            <!-- Header Foto Siswa + Badge Jurusan -->
            <div class="relative">
                <img src="{{ $prestasi->siswa?->foto 
                    ? asset('storage/' . $prestasi->siswa->foto) 
                    : asset('images/default-avatar.jpg') }}"
                     alt="{{ $prestasi->siswa?->name }}"
                     class="w-full h-96 object-cover">

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
                <!-- Judul Prestasi -->
                <h2 class="text-3xl font-bold text-[#0C356A] mb-6">
                    {{ $prestasi->deskripsi }}
                </h2>

                <div class="grid md:grid-cols-2 gap-8 mb-10">
                    <!-- Kiri: Info Lengkap -->
                    <div>
                        <div class="space-y-5">
                            <div>
                                <p class="text-sm text-gray-500 font-medium">Nama Siswa</p>
                                <p class="text-xl font-semibold text-gray-800">
                                    {{ $prestasi->siswa?->name ?? '-' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500 font-medium">Jurusan</p>
                                <p class="text-xl font-semibold text-gray-800">
                                    {{ $prestasi->siswa?->kelas?->jurusan?->nama_jurusan ?? '-' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500 font-medium">Kelas</p>
                                <p class="text-xl font-semibold text-gray-800">
                                    {{ $prestasi->siswa?->kelas?->tingkat ?? '' }} 
                                    {{ $prestasi->siswa?->kelas?->nama_kelas ?? '' }}
                                </p>
                            </div>

                            @if($prestasi->program)
                            <div>
                                <p class="text-sm text-gray-500 font-medium">Penyelenggara / Lomba</p>
                                <p class="text-xl font-semibold text-gray-800">
                                    {{ $prestasi->program->nama ?? $prestasi->program->name ?? '-' }}
                                </p>
                            </div>
                            @endif

                            <div>
                                <p class="text-sm text-gray-500 font-medium">Tanggal Perolehan</p>
                                <p class="text-xl font-semibold text-gray-800">
                                    {{ $prestasi->tanggal ? \Carbon\Carbon::parse($prestasi->tanggal)->format('d F Y') : 'Tidak tercatat' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Kanan: Foto Dokumentasi (jika ada) -->
                    <div>
                        @if($prestasi->dokumentasi && $prestasi->dokumentasi->foto)
                            <div class="bg-gray-100 rounded-xl overflow-hidden shadow-inner">
                                <img src="{{ asset('storage/' . $prestasi->dokumentasi->foto) }}"
                                    alt="Dokumentasi Prestasi"
                                    class="w-full h-80 object-cover hover:scale-105 transition duration-500">
                            </div>
                        @else
                            <div class="bg-gray-100 rounded-xl h-80 flex items-center justify-center border-2 border-dashed border-gray-300">
                                <div class="text-center">
                                    <i class='bx bx-image text-6xl text-gray-400'></i>
                                    <p class="text-gray-500 mt-3">Belum ada foto dokumentasi</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Tombol Share / Kembali (bawah) -->
                <div class="flex justify-between items-center pt-8 border-t border-gray-200">
                    <div class="flex gap-3">
                        <button onclick="navigator.clipboard.writeText(window.location.href)"
                                class="px-5 py-3 bg-[#0C356A] text-white rounded-lg hover:bg-[#0a2b55] transition flex items-center gap-2">
                            <i class='bx bx-share-alt'></i> Bagikan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-whatsapp />
    <x-footer />
</div>