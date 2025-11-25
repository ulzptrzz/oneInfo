<div class="max-w-4xl mx-auto p-6">
    <a href="{{ route('list-program') }}"
        class="inline-flex items-center mb-8 gap-2 px-6 mt-5 py-3.5 bg-[#0C356A] text-white font-semibold rounded-xl hover:bg-[#0a2b55] transform hover:scale-105 transition-all duration-300 shadow-md hover:shadow-xl">
        <i class='bx bx-arrow-back text-xl'></i>
        Semua Program
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
                <img src="{{ asset('storage/' . $program->poster) }}" alt="Poster {{ $program->name }}"
                    class="rounded-lg w-full object-cover shadow-lg cursor-zoom-in transition-transform hover:scale-105"
                    onclick="openLightbox('{{ asset('storage/' . $program->poster) }}')">

                <!-- Lightbox -->
                <div id="lightbox" class="fixed inset-0 z-50 items-center justify-center bg-black bg-opacity-95 hidden"
                    onclick="closeLightbox()">
                    <div class="relative max-w-5xl max-h-full p-4">
                        <img id="lightbox-img" src="" alt="Poster besar"
                            class="max-w-full max-h-screen rounded-lg shadow-2xl">

                        <button
                            class="absolute top-4 right-4 text-white text-6xl font-thin hover:text-gray-400 focus:outline-none">
                            &times;
                        </button>

                        <!-- Petunjuk kecil -->
                        <p class="text-center text-white text-sm mt-4 opacity-70">Klik di mana saja untuk menutup
                        </p>
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
                <div class="pt-8 border-t-2 border-dashed border-gray-200">
                    @if ($sudahTerdaftar)
                        <!-- Sudah terdaftar -->
                        <div class="bg-green-50 rounded-2xl py-4 text-center shadow-lg">
                            <div class="flex flex-col items-center gap-4">
                                <i class="bx bx-check-circle text-5xl text-green-600"></i>
                                <div>
                                    <p class="text-xl font-bold text-green-800">Anda sudah mengikuti</p>
                                    <p class="text-lg font-medium text-green-700">program ini</p>
                                </div>
                            </div>
                        </div>
                    @elseif($bolehDaftar)
                        <!-- Hanya siswa yang login & belum daftar yang bisa lihat tombol ini -->
                        <div class="flex flex-col sm:flex-row gap-6 items-stretch sm:items-center">
                            @if ($program->link_pendaftaran)
                                <a href="{{ $program->link_pendaftaran }}" target="_blank"
                                    onclick="document.getElementById('upload-bukti-btn').classList.remove('hidden');
                             this.innerHTML = 'Link Dibuka';
                             this.classList.add('opacity-70', 'pointer-events-none')"
                                    class="inline-flex items-center justify-center gap-3 px-8 py-5 bg-[#0C356A] hover:bg-[#0a2b56] text-white font-bold text-lg rounded-xl shadow-xl transition transform hover:-translate-y-1">
                                    <i class='bx bx-link-external text-2xl'></i>
                                    Buka Link Pendaftaran
                                </a>
                            @else
                                <button wire:click="confirmPendaftaran()"
                                    class="inline-flex items-center justify-center gap-3 px-8 py-5 bg-[#0C356A] hover:bg-[#0a2b56] text-white font-bold text-lg rounded-xl shadow-xl transition transform hover:-translate-y-1">
                                    <i class='bx bx-link-external text-2xl'></i>
                                    Daftar Sekarang
                                </button>
                            @endif

                            <!-- Tombol upload bukti -->
                            <div id="upload-bukti-btn" class="hidden">
                                <a href="{{ route('guest.bukti-pendaftaran', ['id' => $program->id]) }}"
                                    class="inline-flex items-center justify-center gap-3 px-8 py-5 bg-[#FFC436] hover:bg-[#e0b030] text-[#0C356A] font-bold text-lg rounded-xl shadow-xl transition transform hover:scale-105">
                                    <i class='bx bx-upload text-3xl'></i>
                                    Upload Bukti Pendaftaran
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="bg-gray-100 rounded-2xl py-6 text-center">
                            <p class="text-gray-600 font-medium">
                                @if (Auth::check())
                                    Silakan <a href="{{ route('login') }}"
                                        class="text-[#0C356A] underline font-bold">login</a> sebagai siswa untuk
                                    mendaftar program ini.
                                @endif
                            </p>
                        </div>
                    @endif

                    <!-- Panduan Lomba (tetap sama) -->
                    <div class="mt-8">
                        <p class="text-gray-500 font-medium mb-3">Panduan Lomba</p>
                        @if ($program->panduan_lomba)
                            @if (Str::contains($program->panduan_lomba, '.pdf'))
                                <a href="{{ asset('storage/' . $program->panduan_lomba) }}" target="_blank"
                                    class="inline-flex items-center gap-3 text-[#0C356A] hover:text-[#FFC436] font-semibold">
                                    <i class='bx bxs-file-pdf text-3xl'></i>
                                    Download Panduan (PDF)
                                </a>
                            @elseif(Str::startsWith($program->panduan_lomba, ['http://', 'https://']))
                                <a href="{{ $program->panduan_lomba }}" target="_blank"
                                    class="inline-flex items-center gap-3 text-[#0C356A] hover:text-[#FFC436] font-semibold">
                                    <i class='bx bx-link-external text-xl'></i>
                                    Lihat Panduan Online
                                </a>
                            @endif
                        @else
                            <p class="text-gray-400 italic text-sm">Panduan belum tersedia</p>
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
        @if ($showFormModal)
            <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-70 p-4">
                <div class="bg-white shadow-2xl max-w-2xl w-full max-h-screen overflow-y-auto">

                    <h3 class="text-2xl text-center pt-5 font-bold">Formulir Pendaftaran</h3>

                    @if (session('success'))
                        <div
                            class="bg-green-100 border-2 border-green-500 text-green-800 p-5 rounded-xl text-center font-semibold">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div
                            class="bg-red-100 border-2 border-red-500 text-red-800 p-5 rounded-xl text-center font-semibold">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="p-8 space-y-7">

                        <!-- Info Siswa -->
                        <div class="bg-white rounded-lg p-5 mb-6 shadow">
                            <p class="font-semibold text-gray-700">Nama: {{ $user->name }}</p>
                            <p class="text-gray-600">Kelas: {{ $user->siswa->kelas->tingkat }}
                                {{ $user->siswa->kelas->jurusan->nama_jurusan }}
                                {{ $user->siswa->kelas->nama_kelas }}</p>
                        </div>



                        <!-- Form -->
                        <form wire:submit.prevent="simpanPendaftaran" class="space-y-6">

                            <!-- Mata Lomba -->
                            <div>
                                <label class="block text-gray-800 font-semibold mb-2 text-lg">
                                    Pilih Mata Lomba <span class="text-red-500">*</span>
                                </label>
                                @if (count($mata_lomba) > 0)
                                    <select wire:model.live="mata_lomba_terpilih"
                                        class="w-full border-2 border-gray-300 rounded-xl p-4 text-base focus:border-[#FFC436] focus:outline-none transition"
                                        required>
                                        <option value="">-- Pilih Salah Satu --</option>
                                        @foreach ($mata_lomba as $lomba)
                                            <option value="{{ $lomba }}">{{ $lomba }}</option>
                                        @endforeach
                                    </select>
                                    @error('mata_lomba_terpilih')
                                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                @else
                                    <p class="text-orange-600 bg-orange-50 p-4 rounded-xl">Belum ada mata lomba untuk
                                        program ini.</p>
                                @endif
                            </div>

                            <!-- Upload Kartu Pelajar / Bukti -->
                            <div>
                                <label class="block text-gray-800 font-semibold mb-2 text-lg">
                                    Upload Kartu Pelajar / Bukti Lainnya <span class="text-red-500">*</span>
                                </label>
                                <input type="file" wire:model="foto" accept="image/*,application/pdf"
                                    class="w-full border-2 border-dashed border-gray-400 rounded-xl p-8 bg-gray-50 hover:bg-gray-100 transition text-center cursor-pointer file:mr-4 file:py-3 file:px-6 file:rounded-full file:border-0 file:bg-[#0C356A] file:text-white file:font-semibold hover:file:bg-[#0a2b56]">
                                @error('foto')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Syarat Lain (Opsional) -->
                            <div>
                                <label class="block text-gray-800 font-semibold mb-2 text-lg">
                                    Upload Syarat Lainnya (PDF) <small class="text-gray-500 font-normal">(jika
                                        ada)</small>
                                </label>
                                <input type="file" wire:model="syarat_program" accept="application/pdf"
                                    class="w-full border-2 border-dashed border-gray-300 rounded-xl p-6 bg-gray-50 hover:bg-gray-100 transition file:mr-4 file:py-3 file:px-6 file:rounded-full file:border-0 file:bg-gray-600 file:text-white hover:file:bg-gray-700">
                                @error('syarat_program')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tanggal & Pelaksanaan -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-gray-800 font-semibold mb-2 text-lg">Tanggal
                                        Pendaftaran</label>
                                    <input type="date" wire:model="tanggal_pendaftaran"
                                        class="w-full border-2 border-gray-300 rounded-xl p-4 focus:border-[#FFC436] focus:outline-none">
                                    @error('tanggal_pendaftaran')
                                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-gray-800 font-semibold mb-2 text-lg">Pelaksanaan</label>
                                    <select wire:model="pelaksanaan"
                                        class="w-full border-2 border-gray-300 rounded-xl p-4 focus:border-[#FFC436]">
                                        <option value="online">Online</option>
                                        <option value="offline">Offline</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Tombol Submit & Batal -->
                            <div class="flex flex-col sm:flex-row gap-4 pt-6 justify-center">
                                <button type="submit"
                                    class="order-2 sm:order-1 bg-[#FFC436] hover:bg-[#e6af2e] text-[#0C356A] font-bold py-5 px-12 rounded-2xl text-xl shadow-xl transform hover:scale-105 transition flex items-center justify-center gap-3">
                                    <i class='bx bx-send text-2xl'></i>
                                    Kirim Pendaftaran
                                </button>
                                <button type="button" wire:click="cancelPendaftaran"
                                    class="order-1 sm:order-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-5 px-10 rounded-2xl transition">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
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
