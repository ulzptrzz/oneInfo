<div class="max-w-4xl mx-auto p-6">

    <div class="max-w-4xl mx-auto p-6">

        <a href="{{ route('list-program') }}" class="text-blue-600 hover:underline mb-4 inline-block">
            ← Kembali
        </a>

        <div class="bg-white shadow-lg rounded-xl p-6">
            <div class="bg-[#0C356A] rounded-xl text-white px-6 py-5 flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-semibold">{{ $program->name }}</h2>
                </div>
                <div class="bg-white rounded-full p-1 shadow-md">
                    <livewire:siswa.program.bookmark-toggle :program-id="$program->id" :key="'bookmark-' . $program->id" />
                </div>
            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Poster dengan Lightbox TANPA Library Apapun --}}
                <div class="md:col-span-1 relative">
                    <!-- Gambar thumbnail yang bisa diklik -->
                    <img
                        src="{{ asset('storage/' . $program->poster) }}"
                        alt="Poster {{ $program->name }}"
                        class="rounded-lg w-full object-cover shadow-lg cursor-zoom-in transition-transform hover:scale-105"
                        onclick="openLightbox('{{ asset('storage/' . $program->poster) }}')">

                    <!-- Lightbox (awalnya hidden) -->
                    <div id="lightbox" class="fixed inset-0 z-50 items-center justify-center bg-black bg-opacity-95 hidden" onclick="closeLightbox()">
                        <div class="relative max-w-5xl max-h-full p-4">
                            <img id="lightbox-img" src="" alt="Poster besar" class="max-w-full max-h-screen rounded-lg shadow-2xl">

                            <!-- Tombol X besar X -->
                            <button class="absolute top-4 right-4 text-white text-6xl font-thin hover:text-gray-400 focus:outline-none">
                                &times;
                            </button>

                            <!-- Petunjuk kecil -->
                            <p class="text-center text-white text-sm mt-4 opacity-70">Klik di mana saja untuk menutup</p>
                        </div>
                    </div>
                </div>

                {{-- Detail --}}
                <div class="md:col-span-2 space-y-6">
                    {{-- Tanggal --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-500 font-semibold text-sm">Tanggal Mulai</p>
                            <p class="font-medium">
                                {{ \Carbon\Carbon::parse($program->tanggal_mulai)->translatedFormat('d F Y') }}
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-500 font-semibold text-sm">Tanggal Selesai</p>
                            <p class="font-medium">
                                {{ \Carbon\Carbon::parse($program->tanggal_selesai)->translatedFormat('d F Y') }}
                            </p>
                        </div>
                    </div>

                    {{-- Tingkat & Lomba --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-500 font-semibold text-sm">Tingkat</p>
                            <p>{{ $program->tingkat }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500 font-semibold text-sm">Pelaksanaan</p>
                            <p>{{ $program->pelaksanaan }}</p>

                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-500 font-semibold text-sm">Penyelenggara</p>
                            <ul class="list-disc ml-5 space-y-1">
                                @foreach (json_decode($program->penyelenggara, true) as $pg)
                                <li>{{ $pg }}</li>
                                @endforeach
                            </ul>
                        </div>
                        
                        <div>
                            <p class="text-gray-500 font-semibold text-sm">Mata Lomba</p>

                            <div class="flex flex-wrap gap-2">
                                @foreach (json_decode($program->mata_lomba, true) as $ml)
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-500 rounded-full text-sm">
                                    {{ $ml }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    {{-- Link Pendaftaran --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>

                            <p class="text-gray-500 font-semibold text-sm mb-1">Link Pendaftaran</p>

                            @if ($program->link_pendaftaran)
                            <a href="{{ $program->link_pendaftaran }}" target="_blank"
                                class="text-blue-600 underline">
                                Buka Link Pendaftaran
                            </a>
                            @else
                            <p class="text-gray-400 italic">Tidak ada link pendaftaran</p>
                            @endif
                        </div>

                        <div>
                            <p class="text-gray-500 font-semibold text-sm mb-1">Panduan Lomba</p>

                            @if(Str::contains($program->panduan_lomba, '.pdf'))
                            <a href="{{ asset('storage/' . $program->panduan_lomba) }}" target="_blank">
                                <i class='bx bx-file text-lg'></i> Download Panduan PDF
                            </a>
                            @endif


                            @if(Str::startsWith($program->panduan_lomba, 'http'))
                            <a href="{{ $program->panduan_lomba }}" target="_blank">
                                Lihat Panduan
                            </a>
                            @endif

                        </div>
                    </div>


                </div>
            </div>

            <div class="px-6 pb-6">
                <div class="bg-[#FFF7E8] border rounded-xl p-5 shadow-sm">
                    <p class="text-gray-500 font-semibold text-sm mb-2">Deskripsi</p>

                    <p class="text-gray-800 leading-relaxed">
                        {{ $program->deskripsi }}
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    function openLightbox(imageUrl) {
        const lightbox = document.getElementById('lightbox');
        const img = document.getElementById('lightbox-img');
        img.src = imageUrl;
        lightbox.classList.remove('hidden');
        lightbox.classList.add('flex');
        document.body.style.overflow = 'hidden'; // biar ga bisa scroll pas buka
    }

    function closeLightbox() {
        const lightbox = document.getElementById('lightbox');
        lightbox.classList.add('hidden');
        lightbox.classList.remove('flex');
        document.body.style.overflow = 'auto';
    }

    // Tutup dengan tombol ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeLightbox();
    });
</script>