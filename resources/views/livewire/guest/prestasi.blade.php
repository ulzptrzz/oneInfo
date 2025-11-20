<div>
    <x-navbar />

    <!-- SECTION PRESTASI -->
    <div class="max-w-7xl mx-auto p-6">

        <!-- Header + Search Jurusan (pojok kanan atas) -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
            <div class="text-center md:text-left">
                <h2 class="text-4xl md:text-5xl font-bold text-[#0C356A]">
                    Prestasi <span class="text-[#ffc436]">Siswa</span>
                </h2>
                <p class="text-lg text-gray-600 mt-2">
                    Berbagai prestasi membanggakan yang telah diraih oleh siswa-siswi kami
                </p>
            </div>

            <!-- Filter Jurusan -->
            <div class="w-full md:w-64">
                <select wire:model.live="searchJurusan"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#ffc436] focus:border-transparent text-gray-700">
                    <option value="">Semua Jurusan</option>
                    @foreach($jurusans as $jurusan)
                        <option value="{{ $jurusan->id }}">{{ $jurusan->nama_jurusan }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Grid Prestasi -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($prestasis as $prestasi)
                @php
                    $siswa     = $prestasi->siswa;
                    $jurusan   = $siswa?->kelas?->jurusan?->nama_jurusan ?? 'Tidak Ada Jurusan';
                    $fotoSiswa = $siswa?->foto 
                        ? asset('storage/' . $siswa->foto) 
                        : asset('images/default-avatar.jpg');
                @endphp

                <div class="bg-white rounded-xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden flex flex-col h-full">
                    <!-- Foto Siswa -->
                    <div class="relative">
                        <img src="{{ $fotoSiswa }}"
                             alt="{{ $siswa?->name }}"
                             class="w-full h-64 object-cover">

                        <!-- Badge Jurusan di dalam card (pindah dari luar) -->
                        <div class="absolute bottom-4 left-4">
                            <span class="bg-[#ffc436] text-[#0C356A] px-4 py-2 rounded-full text-sm font-bold shadow-lg">
                                {{ $jurusan }}
                            </span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="text-xl font-bold text-[#0C356A] line-clamp-2">
                            {{ $siswa?->name ?? 'Nama Tidak Diketahui' }}
                        </h3>

                        <p class="text-lg font-semibold text-gray-800 mt-2 line-clamp-2">
                            {{ $prestasi->deskripsi }}
                        </p>

                        @if($prestasi->program)
                            <p class="text-sm text-gray-600 mt-2">
                                <span class="font-medium">Penyelenggara:</span>
                                {{ $prestasi->program->nama ?? $prestasi->program->name ?? '' }}
                            </p>
                        @endif

                        <!-- Tombol Detail -->
                        <a href="{{ route('guest.prestasi.detail', $prestasi->id) }}"
                            class="inline-block mt-3 text-blue-600 font-semibold hover:underline">
                            Lihat Detail →
                        </a>
                    </div>
                </div>            
            @empty
                <div class="col-span-full">
                    <div class="bg-[#D6EBFF] rounded-xl flex flex-col items-center justify-center py-8 px-4 text-center">
                        <svg width="120px" height="120px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" class="mb-3">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M9.29289 1.29289C9.48043 1.10536 9.73478 1 10 1H18C19.6569 1 21 2.34315 21 4V7C21 7.55228 20.5523 8 20 8C19.4477 8 19 7.55228 19 7V4C19 3.44772 18.5523 3 18 3H11V8C11 8.55228 10.5523 9 10 9H5V20C5 20.5523 5.44772 21 6 21H11C11.5523 21 12 21.4477 12 22C12 22.5523 11.5523 23 11 23H6C4.34315 23 3 21.6569 3 20V8C3 7.73478 3.10536 7.48043 3.29289 7.29289L9.29289 1.29289ZM6.41421 7H9V4.41421L6.41421 7ZM18.25 20.75C18.25 21.4404 17.6904 22 17 22C16.3096 22 15.75 21.4404 15.75 20.75C15.75 20.0596 16.3096 19.5 17 19.5C17.6904 19.5 18.25 20.0596 18.25 20.75ZM15.1353 12.9643C15.3999 12.4596 16.0831 12 17 12C18.283 12 19 12.8345 19 13.5C19 14.1655 18.283 15 17 15C16.4477 15 16 15.4477 16 16V17C16 17.5523 16.4477 18 17 18C17.5523 18 18 17.5523 18 17V16.8866C19.6316 16.5135 21 15.2471 21 13.5C21 11.404 19.0307 10 17 10C15.4566 10 14.0252 10.7745 13.364 12.0357C13.1075 12.5248 13.2962 13.1292 13.7853 13.3857C14.2744 13.6421 14.8788 13.4535 15.1353 12.9643Z"
                                fill="#0C356A" />
                        </svg>
                        <p class="text-[#0C356A] font-semibold text-[17px]">
                            {{ $searchJurusan ? 'Tidak ada prestasi di jurusan ini' : 'Belum ada Prestasi' }}
                        </p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <x-whatsapp />
    <x-footer />

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</div>