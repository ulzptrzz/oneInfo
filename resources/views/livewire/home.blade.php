<div>
    <style>
        .hero-gradient {
            background: linear-gradient(135deg, #0C356A 0%, #1e40af 50%, #3b82f6 100%);
        }

        .stat-card-hover {
            transition: all 0.3s ease;
        }

        .stat-card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(12, 53, 106, 0.2);
        }

        .feature-card-hover {
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .feature-card-hover:hover {
            transform: translateY(-10px);
            border-color: #ffc436;
            box-shadow: 0 20px 40px rgba(255, 196, 54, 0.3);
        }

        .program-card-hover {
            transition: all 0.3s ease;
        }

        .program-card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(12, 53, 106, 0.2);
        }

        .achievement-card-hover {
            transition: all 0.3s ease;
        }

        .achievement-card-hover:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 30px rgba(255, 196, 54, 0.4);
        }

        .shine-effect {
            position: relative;
            overflow: hidden;
        }

        .shine-effect::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transform: rotate(45deg);
            animation: shine 3s infinite;
        }

        @keyframes shine {
            0% {
                transform: translateX(-100%) translateY(-100%) rotate(45deg);
            }

            100% {
                transform: translateX(100%) translateY(100%) rotate(45deg);
            }
        }

        .scroll-animate {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease-out;
        }

        .scroll-animate.active {
            opacity: 1;
            transform: translateY(0);
        }

        .btn-hover-scale {
            transition: all 0.3s ease;
        }

        .btn-hover-scale:hover {
            transform: translateY(-3px) scale(1.05);
        }

        .link-arrow-slide {
            transition: all 0.3s ease;
        }

        .link-arrow-slide:hover .arrow-icon {
            transform: translateX(8px);
        }

        .arrow-icon {
            transition: transform 0.3s ease;
            display: inline-block;
        }
    </style>

    <header class="text-white">
        <x-navbar />

        {{-- HERO SECTION --}}
        <div class="hero-gradient pt-28 px-7 relative overflow-hidden">
            <div class="absolute w-96 h-96 bg-[#ffc436] opacity-10 rounded-full -top-40 -right-20"></div>
            <div class="absolute w-80 h-80 bg-[#ffc436] opacity-5 rounded-full -bottom-40 -left-20"></div>

            <div class="max-w-6xl mx-auto grid md:grid-cols-2 -bottom-6 gap-10 items-center relative z-10">
                <div class="py-10 md:py-20">
                    <div class="pb-16">
                        <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mb-6">
                            Jelajahi berbagai program dan lomba menarik di <span class="text-[#ffc436]">OneInfo</span>!
                        </h1>
                        <p class="mt-4 text-lg md:text-xl opacity-90 mb-8">
                            Website pusat informasi SMKN 1 Kota Bekasi mengenai berbagai program, lomba, dan kursus untuk
                            pelajar berprestasi
                        </p>
                        <div class="flex flex-wrap gap-4">
                            <a href="#program"
                                class="bg-[#ffc436] text-[#0C356A] px-8 py-3 rounded-full font-semibold text-lg shadow-lg btn-hover-scale inline-block">
                                Lihat Program
                            </a>
                            <a href="#tentang"
                                class="border-2 border-white text-white px-8 py-3 rounded-full font-semibold text-lg hover:bg-white hover:text-[#0C356A] transition-all duration-300 inline-block">
                                Pelajari Lebih Lanjut
                            </a>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center">
                    <img class="w-full max-w-lg drop-shadow-2xl" src="{{ asset('assets/gambar-hero.png') }}"
                        alt="gambar-hero">
                </div>
            </div>
        </div>
    </header>

    {{-- STATS SECTION --}}
    <section class="py-16 px-7 bg-white -mt-10 relative z-20">
        <div class="max-w-6xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="stat-card-hover bg-gradient-to-br from-blue-50 to-blue-100 p-8 rounded-2xl text-center">
                <div class="text-5xl font-bold text-[#0C356A] mb-2">{{ $totalProgram ?? '0' }}</div>
                <div class="text-gray-600 font-medium">Program Tersedia</div>
            </div>
            <div class="stat-card-hover bg-gradient-to-br from-blue-50 to-blue-100 p-8 rounded-2xl text-center">
                <div class="text-5xl font-bold text-[#0C356A] mb-2">{{ $totalSiswa ?? '0' }}</div>
                <div class="text-gray-600 font-medium">Siswa Terdaftar</div>
            </div>
            <div class="stat-card-hover bg-gradient-to-br from-blue-50 to-blue-100 p-8 rounded-2xl text-center">
                <div class="text-5xl font-bold text-[#0C356A] mb-2">{{ $totalPrestasi ?? '0' }}</div>
                <div class="text-gray-600 font-medium">Prestasi Diraih</div>
            </div>
            <div class="stat-card-hover bg-gradient-to-br from-blue-50 to-blue-100 p-8 rounded-2xl text-center">
                <div class="text-5xl font-bold text-[#0C356A] mb-2">{{ $totalArtikel ?? '0' }}</div>
                <div class="text-gray-600 font-medium">Artikel Menarik</div>
            </div>
        </div>
    </section>

    <section id="program" class="py-20 px-7 bg-white">
        {{-- KATALOG PROGRAM --}}
        <x-katalog-program :program="$program" />
    </section>

    {{-- SECTION PRESTASI --}}
    <section id="prestasi" class="py-20 px-7 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-[#0C356A] mb-4">
                    Prestasi <span class="text-[#ffc436]">Siswa</span>
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    SMKN 1 Kota Bekasi terus melahirkan generasi berprestasi yang unggul di berbagai bidang
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($prestasis as $prestasi)
                    @php
                        $siswa = $prestasi->siswa;
                        $jurusan = $siswa?->kelas?->jurusan?->nama_jurusan ?? 'Tidak Ada Jurusan';
                        $fotoSiswa = $siswa?->foto
                            ? asset('storage/' . $siswa->foto)
                            : asset('images/default-avatar.jpg');
                    @endphp

                    <div
                        class="bg-white rounded-xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden flex flex-col h-full">
                        <!-- Foto Siswa -->
                        <div class="relative">
                            <img src="{{ $fotoSiswa }}" alt="{{ $siswa?->name }}" class="w-full h-64 object-cover">

                            <div class="absolute bottom-4 left-4">
                                <span
                                    class="bg-[#ffc436] text-[#0C356A] px-4 py-2 rounded-full text-sm font-bold shadow-lg">
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

                            @if ($prestasi->program)
                                <p class="text-sm text-gray-600 mt-2">
                                    <span class="font-medium">Program:</span>
                                    {{ $prestasi->program->nama ?? ($prestasi->program->name ?? '') }}
                                </p>
                            @endif

                            <!-- Tombol Detail -->
                            <div class="pt-3 mt-2">
                                <a href="{{ route('guest.prestasi.detail', $prestasi->id) }}"
                                    class="inline-flex items-center gap-2 w-full justify-center px-6 py-3.5 bg-[#0C356A] text-white font-semibold rounded-xl hover:bg-[#0a2b55] transform hover:scale-105 transition-all duration-300 shadow-md hover:shadow-xl">
                                    <span>Lihat Detail</span>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div
                            class="bg-[#D6EBFF] rounded-xl flex flex-col items-center justify-center py-8 px-4 text-center">
                            <svg width="120px" height="120px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="mb-3">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M9.29289 1.29289C9.48043 1.10536 9.73478 1 10 1H18C19.6569 1 21 2.34315 21 4V7C21 7.55228 20.5523 8 20 8C19.4477 8 19 7.55228 19 7V4C19 3.44772 18.5523 3 18 3H11V8C11 8.55228 10.5523 9 10 9H5V20C5 20.5523 5.44772 21 6 21H11C11.5523 21 12 21.4477 12 22C12 22.5523 11.5523 23 11 23H6C4.34315 23 3 21.6569 3 20V8C3 7.73478 3.10536 7.48043 3.29289 7.29289L9.29289 1.29289ZM6.41421 7H9V4.41421L6.41421 7ZM18.25 20.75C18.25 21.4404 17.6904 22 17 22C16.3096 22 15.75 21.4404 15.75 20.75C15.75 20.0596 16.3096 19.5 17 19.5C17.6904 19.5 18.25 20.0596 18.25 20.75ZM15.1353 12.9643C15.3999 12.4596 16.0831 12 17 12C18.283 12 19 12.8345 19 13.5C19 14.1655 18.283 15 17 15C16.4477 15 16 15.4477 16 16V17C16 17.5523 16.4477 18 17 18C17.5523 18 18 17.5523 18 17V16.8866C19.6316 16.5135 21 15.2471 21 13.5C21 11.404 19.0307 10 17 10C15.4566 10 14.0252 10.7745 13.364 12.0357C13.1075 12.5248 13.2962 13.1292 13.7853 13.3857C14.2744 13.6421 14.8788 13.4535 15.1353 12.9643Z"
                                    fill="#0C356A" />
                            </svg>
                            <p class="text-[#0C356A] font-semibold text-[17px]">
                            {{-- {{ $searchJurusan ? 'Tidak ada prestasi di jurusan ini' : 'Belum ada Prestasi' }} --}}    
                            </p>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="text-center mt-16">
                <a href="{{ route('list-prestasi') }}"
                    class="bg-[#0C356A] text-white px-16 py-5 rounded-lg text-xl font-semibold hover:bg-[#082954] transition">
                    Lihat Lebih Banyak </a>
            </div>
        </div>
    </section>

    {{-- SECTION ARTICLE  --}}
    <section id="artikel" class="py-20 px-7 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-[#0C356A] mb-4">
                    Artikel <span class="text-[#ffc436]">Terbaru</span>
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Baca artikel dan berita terkini seputar kegiatan SMKN 1 Kota Bekasi
                </p>
            </div>

            @if ($artikel)
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden grid md:grid-cols-2 gap-0 scroll-animate">
                    <div class="h-full">
                        <img src="{{ $artikel->thumbnail ? asset('storage/' . $artikel->thumbnail) : asset('assets/foto-artikel.jpg') }}"
                            alt="{{ $artikel->judul }}" class="w-full h-full object-cover">
                    </div>

                    <div class="p-8 md:p-10 flex flex-col justify-center">
                        <h3 class="text-3xl font-bold text-gray-800 mb-4">{{ $artikel->judul }}</h3>
                        <p class="text-gray-500 text-sm mb-4">
                            Waktu Upload : {{ $artikel->tanggal }}
                        </p>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            {{ $artikel->deskripsi }}
                        </p>
                        <a href="{{ route('guest.artikel.detail', $artikel->id) }}"
                            class="link-arrow-slide text-[#0C356A] font-bold inline-flex items-center hover:text-[#ffc436] text-lg">
                            View Event Details
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 arrow-icon" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            @else
                <div class="col-span-1 md:col-span-2 lg:col-span-3">
                    <div
                        class="bg-[#D6EBFF] rounded-xl flex flex-col items-center justify-center py-8 px-4 text-center">
                        <svg width="120px" height="120px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" class="mb-3">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M9.29289 1.29289C9.48043 1.10536 9.73478 1 10 1H18C19.6569 1 21 2.34315 21 4V7C21 7.55228 20.5523 8 20 8C19.4477 8 19 7.55228 19 7V4C19 3.44772 18.5523 3 18 3H11V8C11 8.55228 10.5523 9 10 9H5V20C5 20.5523 5.44772 21 6 21H11C11.5523 21 12 21.4477 12 22C12 22.5523 11.5523 23 11 23H6C4.34315 23 3 21.6569 3 20V8C3 7.73478 3.10536 7.48043 3.29289 7.29289L9.29289 1.29289ZM6.41421 7H9V4.41421L6.41421 7ZM18.25 20.75C18.25 21.4404 17.6904 22 17 22C16.3096 22 15.75 21.4404 15.75 20.75C15.75 20.0596 16.3096 19.5 17 19.5C17.6904 19.5 18.25 20.0596 18.25 20.75ZM15.1353 12.9643C15.3999 12.4596 16.0831 12 17 12C18.283 12 19 12.8345 19 13.5C19 14.1655 18.283 15 17 15C16.4477 15 16 15.4477 16 16V17C16 17.5523 16.4477 18 17 18C17.5523 18 18 17.5523 18 17V16.8866C19.6316 16.5135 21 15.2471 21 13.5C21 11.404 19.0307 10 17 10C15.4566 10 14.0252 10.7745 13.364 12.0357C13.1075 12.5248 13.2962 13.1292 13.7853 13.3857C14.2744 13.6421 14.8788 13.4535 15.1353 12.9643Z"
                                fill="#0C356A" />
                        </svg>
                        <p class="text-[#0C356A] font-semibold text-[15px]">Belum ada Artikel</p>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <section class="py-20 px-7 bg-white">
        <div class="max-w-6xl mx-auto">

            {{-- Q&A SECTION --}}
            <div class="mt-16">
                <div class="text-center mb-8">
                    <h2 class="text-4xl md:text-5xl font-bold text-[#0C356A] mb-4">
                        Pertanyaan <span class="text-[#ffc436]">Umum</span>
                    </h2>
                </div>

                <div class="space-y-4 max-w-4xl mx-auto">
                    <!-- Item 1 -->
                    <details class="group border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                        <summary
                            class="flex justify-between items-center p-5 text-left text-[#0C356A] font-semibold cursor-pointer list-none bg-white hover:bg-gray-50 transition-colors">
                            <span>Apa tujuan dari kegiatan TOEIC 2025?</span>
                            <svg class="w-5 h-5 text-[#0C356A] transition-transform group-open:rotate-180"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </summary>
                        <div class="px-5 pb-5 pt-2 text-gray-600 bg-gray-50">
                            Kegiatan ini bertujuan meningkatkan kemampuan bahasa Inggris siswa khususnya dalam
                            menghadapi tes TOEIC.
                        </div>
                    </details>

                    <!-- Item 2 -->
                    <details class="group border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                        <summary
                            class="flex justify-between items-center p-5 text-left text-[#0C356A] font-semibold cursor-pointer list-none bg-white hover:bg-gray-50 transition-colors">
                            <span>Siapa yang dapat mengikuti kegiatan ini?</span>
                            <svg class="w-5 h-5 text-[#0C356A] transition-transform group-open:rotate-180"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </summary>
                        <div class="px-5 pb-5 pt-2 text-gray-600 bg-gray-50">
                            Seluruh siswa SMKN 1 Kota Bekasi yang ingin meningkatkan kemampuan berbahasa Inggris dapat
                            mengikuti kegiatan ini.
                        </div>
                    </details>

                    <!-- Item 3 -->
                    <details class="group border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                        <summary
                            class="flex justify-between items-center p-5 text-left text-[#0C356A] font-semibold cursor-pointer list-none bg-white hover:bg-gray-50 transition-colors">
                            <span>Apakah kegiatan ini berbayar?</span>
                            <svg class="w-5 h-5 text-[#0C356A] transition-transform group-open:rotate-180"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </summary>
                        <div class="px-5 pb-5 pt-2 text-gray-600 bg-gray-50">
                            Tidak, kegiatan ini sepenuhnya gratis untuk siswa.
                        </div>
                    </details>
                </div>
            </div>
        </div>
    </section>


    {{-- SECTION TENTANG - Enhanced --}}
    <section id="tentang" class="py-20 px-7 bg-gradient-to-br from-gray-50 to-blue-50">
        <div class="max-w-6xl mx-auto">
            <div class="bg-white rounded-3xl shadow-2xl p-10 md:p-16 scroll-animate">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div class="flex justify-center">
                        <img src="{{ asset('assets/logo-smk.png') }}" alt="Logo SMKN 1" class="w-64 h-auto">
                    </div>
                    <div>
                        <h2 class="text-4xl md:text-5xl font-bold mb-6">
                            Tentang <span class="text-[#ffc436]">OneInfo.id</span>
                        </h2>
                        <p class="text-lg text-gray-700 leading-relaxed mb-6">
                            OneInfo.id adalah platform informasi sekolah yang dirancang untuk memudahkan siswa, guru,
                            dan masyarakat dalam mengakses berbagai kegiatan di SMKN 1 Kota Bekasi.
                        </p>
                        <p class="text-lg text-gray-700 leading-relaxed">
                            Melalui OneInfo.id, kamu bisa menemukan program, lomba, dan prestasi terbaru secara cepat
                            dan terorganisir. Website ini hadir untuk menjadi sumber informasi terpercaya dan inspiratif
                            bagi seluruh warga sekolah.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA SECTION - New Addition --}}
    <section class="py-20 px-7 hero-gradient relative overflow-hidden">
        <div class="absolute w-96 h-96 bg-[#ffc436] opacity-10 rounded-full -top-20 right-1/4"></div>

        <div class="max-w-4xl mx-auto text-center text-white relative z-10">
            <h2 class="text-4xl md:text-5xl font-bold mb-6">
                Siap Bergabung dengan OneInfo.id?
            </h2>
            <p class="text-xl mb-10 opacity-90">
                Jangan lewatkan kesempatan untuk mengembangkan potensi diri dan meraih prestasi gemilang bersama kami
            </p>
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="#"
                    class="bg-[#ffc436] text-[#0C356A] px-10 py-4 rounded-full font-bold text-lg shadow-lg btn-hover-scale inline-block">
                    Daftar Sekarang
                </a>
                <a href="#"
                    class="border-2 border-white text-white px-10 py-4 rounded-full font-bold text-lg hover:bg-white hover:text-[#0C356A] transition-all duration-300 inline-block">
                    Hubungi Kami
                </a>
            </div>
        </div>
        <x-whatsapp />
    </section>

    {{-- SECTION FOOTER --}}
    <x-footer />

    {{-- Scroll Animation Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const animateElements = document.querySelectorAll('.scroll-animate');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            animateElements.forEach(element => {
                observer.observe(element);
            });

            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>
</div>
