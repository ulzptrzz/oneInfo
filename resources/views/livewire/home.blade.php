<div>
    <style>
        /* Custom Styles for OneInfo Landing Page */
        .hero-gradient {
            background: linear-gradient(135deg, #0C356A 0%, #1e40af 50%, #3b82f6 100%);
        }

        .hero-float {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
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

        {{-- HERO SECTION - Enhanced --}}
        <div class="hero-gradient pt-28 pb-16 px-7 relative overflow-hidden">
            {{-- Decorative Elements --}}
            <div class="absolute w-96 h-96 bg-[#ffc436] opacity-10 rounded-full -top-40 -right-20"></div>
            <div class="absolute w-80 h-80 bg-[#ffc436] opacity-5 rounded-full -bottom-40 -left-20"></div>

            <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-10 items-center relative z-10">
                <div class="py-10 md:py-20">
                    <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mb-6">
                        Jelajahi berbagai program dan lomba menarik di <span class="text-[#ffc436]">OneInfo</span>!
                    </h1>
                    <p class="mt-4 text-lg md:text-xl opacity-90 mb-8">
                        Website pusat informasi SMKN 1 Kota Bekasi mengenai berbagai program, lomba, dan kursus untuk pelajar berprestasi
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="#program" class="bg-[#ffc436] text-[#0C356A] px-8 py-3 rounded-full font-semibold text-lg shadow-lg btn-hover-scale inline-block">
                            Lihat Program
                        </a>
                        <a href="#tentang" class="border-2 border-white text-white px-8 py-3 rounded-full font-semibold text-lg hover:bg-white hover:text-[#0C356A] transition-all duration-300 inline-block">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>

                <div class="flex justify-center">
                    <img class="w-full max-w-lg hero-float drop-shadow-2xl" src="{{ asset('assets/gambar-hero.png') }}" alt="gambar-hero">
                </div>
            </div>
        </div>
    </header>

    {{-- STATS SECTION - New Addition --}}
    <section class="py-16 px-7 bg-white -mt-10 relative z-20">
        <div class="max-w-6xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="stat-card-hover bg-gradient-to-br from-blue-50 to-blue-100 p-8 rounded-2xl text-center">
                <div class="text-5xl font-bold text-[#0C356A] mb-2">50+</div>
                <div class="text-gray-600 font-medium">Program Tersedia</div>
            </div>
            <div class="stat-card-hover bg-gradient-to-br from-blue-50 to-blue-100 p-8 rounded-2xl text-center">
                <div class="text-5xl font-bold text-[#0C356A] mb-2">1000+</div>
                <div class="text-gray-600 font-medium">Siswa Terdaftar</div>
            </div>
            <div class="stat-card-hover bg-gradient-to-br from-blue-50 to-blue-100 p-8 rounded-2xl text-center">
                <div class="text-5xl font-bold text-[#0C356A] mb-2">100+</div>
                <div class="text-gray-600 font-medium">Prestasi Diraih</div>
            </div>
            <div class="stat-card-hover bg-gradient-to-br from-blue-50 to-blue-100 p-8 rounded-2xl text-center">
                <div class="text-5xl font-bold text-[#0C356A] mb-2">25+</div>
                <div class="text-gray-600 font-medium">Lomba Aktif</div>
            </div>
        </div>
    </section>

    <section class="py-20 px-7 bg-white">
        {{-- KATALOG PROGRAM - Enhanced --}}
        <x-katalog-program :program="$program"/>
    </section>

    {{-- SECTION PRESTASI - Enhanced --}}
    <section id="prestasi" class="py-20 px-7 bg-white">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-[#0C356A] mb-4">
                    Prestasi <span class="text-[#ffc436]">Siswa</span>
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    SMKN 1 Kota Bekasi terus melahirkan generasi berprestasi yang unggul di berbagai bidang
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="achievement-card-hover bg-gradient-to-br from-yellow-100 to-yellow-200 rounded-2xl overflow-hidden shadow-lg scroll-animate">
                    <img class="w-full h-48 object-cover" src="{{ asset('assets/TOEIC.png') }}" alt="Achievement">
                    <div class="p-6 text-center">
                        <h3 class="text-lg font-bold text-[#0C356A] mb-2">Mathilda Anneke Waworuntu</h3>
                        <p class="text-gray-700">Juara 2 Runner Up Harvard Essay Competition</p>
                    </div>
                </div>

                <div class="achievement-card-hover bg-gradient-to-br from-yellow-100 to-yellow-200 rounded-2xl overflow-hidden shadow-lg scroll-animate">
                    <img class="w-full h-48 object-cover" src="{{ asset('assets/TOEIC.png') }}" alt="Achievement">
                    <div class="p-6 text-center">
                        <h3 class="text-lg font-bold text-[#0C356A] mb-2">Tim Olimpiade Sains</h3>
                        <p class="text-gray-700">Medali Emas OSN Tingkat Provinsi</p>
                    </div>
                </div>

                <div class="achievement-card-hover bg-gradient-to-br from-yellow-100 to-yellow-200 rounded-2xl overflow-hidden shadow-lg scroll-animate">
                    <img class="w-full h-48 object-cover" src="{{ asset('assets/TOEIC.png') }}" alt="Achievement">
                    <div class="p-6 text-center">
                        <h3 class="text-lg font-bold text-[#0C356A] mb-2">Tim Debat Bahasa Inggris</h3>
                        <p class="text-gray-700">Juara 1 National English Debate</p>
                    </div>
                </div>

                <div class="achievement-card-hover bg-gradient-to-br from-yellow-100 to-yellow-200 rounded-2xl overflow-hidden shadow-lg scroll-animate">
                    <img class="w-full h-48 object-cover" src="{{ asset('assets/TOEIC.png') }}" alt="Achievement">
                    <div class="p-6 text-center">
                        <h3 class="text-lg font-bold text-[#0C356A] mb-2">Tim Innovation Challenge</h3>
                        <p class="text-gray-700">Best Innovation Award 2025</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- SECTION ARTICLE - Enhanced --}}
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

            <div class="bg-white rounded-2xl shadow-xl overflow-hidden grid md:grid-cols-2 gap-0 scroll-animate">
                <div class="h-full">
                    <img src="{{ asset('assets/foto-artikel.jpg') }}" alt="foto-artikel" class="w-full h-full object-cover">
                </div>

                <div class="p-8 md:p-10 flex flex-col justify-center">
                    <h3 class="text-3xl font-bold text-gray-800 mb-4">Title of the Risen Event</h3>
                    <p class="text-gray-500 text-sm mb-4">
                        📍 1015 California Ave, Los Angeles CA <br>
                        <span class="text-gray-600">🕐 7:00 pm — 8:00 pm</span>
                    </p>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam dignissim eu turpis non hendrerit. Nunc nec luctus tellus.
                    </p>
                    <a href="#" class="link-arrow-slide text-[#0C356A] font-bold inline-flex items-center hover:text-[#ffc436] text-lg">
                        View Event Details
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 arrow-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- SECTION DOKUMENTASI - Enhanced --}}
    <section class="py-20 px-7 bg-white">
        <div class="max-w-6xl mx-auto">

            {{-- TITLE --}}
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-[#0C356A] mb-4">
                    Dokumentasi <span class="text-[#ffc436]">Kegiatan</span>
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Lihat dokumentasi berbagai kegiatan dan program di SMKN 1 Kota Bekasi
                </p>
            </div>

            {{-- CARD --}}
            <div class="bg-white shadow-xl rounded-2xl overflow-hidden scroll-animate">
                <div class="shine-effect">

                    {{-- GAMBAR --}}
                    <img class="w-full h-64 object-cover"
                        src="{{ asset('assets/TOEIC.png') }}"
                        alt="Documentation">
                </div>

                <div class="p-8 bg-gradient-to-br from-blue-50 to-white">
                    <h3 class="text-2xl font-bold text-[#0C356A] mb-3">
                        TOEIC 2025 Refresher Webinar
                    </h3>
                    <p class="text-gray-700 leading-relaxed">
                        Program pelatihan intensif untuk meningkatkan kemampuan bahasa Inggris siswa
                        dalam menghadapi tes TOEIC standar internasional.
                    </p>
                </div>
            </div>

            {{-- Q&A SECTION --}}
            <div class="mt-16">
                <div class="text-center mb-8">
                    <h2 class="text-4xl md:text-5xl font-bold text-[#0C356A] mb-4">
                        Pertanyaan <span class="text-[#ffc436]">Umum</span>
                    </h2>
                </div>

                <div class="space-y-4">

                    {{-- ITEM 1 --}}
                    <div x-data="{ open: false }" class="border border-gray-200 rounded-xl shadow-sm">
                        <button @click="open = !open"
                            class="w-full flex justify-between items-center p-5 text-left text-[#0C356A] font-semibold">
                            Apa tujuan dari kegiatan TOEIC 2025?
                            <span x-text="open ? '-' : '+'"></span>
                        </button>
                        <div x-show="open" x-collapse class="px-5 pb-5 text-gray-600">
                            Kegiatan ini bertujuan meningkatkan kemampuan bahasa Inggris siswa khususnya dalam menghadapi tes TOEIC.
                        </div>
                    </div>

                    {{-- ITEM 2 --}}
                    <div x-data="{ open: false }" class="border border-gray-200 rounded-xl shadow-sm">
                        <button @click="open = !open"
                            class="w-full flex justify-between items-center p-5 text-left text-[#0C356A] font-semibold">
                            Siapa yang dapat mengikuti kegiatan ini?
                            <span x-text="open ? '-' : '+'"></span>
                        </button>
                        <div x-show="open" x-collapse class="px-5 pb-5 text-gray-600">
                            Seluruh siswa SMKN 1 Kota Bekasi yang ingin meningkatkan kemampuan berbahasa Inggris dapat mengikuti kegiatan ini.
                        </div>
                    </div>

                    {{-- ITEM 3 --}}
                    <div x-data="{ open: false }" class="border border-gray-200 rounded-xl shadow-sm">
                        <button @click="open = !open"
                            class="w-full flex justify-between items-center p-5 text-left text-[#0C356A] font-semibold">
                            Apakah kegiatan ini berbayar?
                            <span x-text="open ? '-' : '+'"></span>
                        </button>
                        <div x-show="open" x-collapse class="px-5 pb-5 text-gray-600">
                            Tidak, kegiatan ini sepenuhnya gratis untuk siswa.
                        </div>
                    </div>

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
                            OneInfo.id adalah platform informasi sekolah yang dirancang untuk memudahkan siswa, guru, dan masyarakat dalam mengakses berbagai kegiatan di SMKN 1 Kota Bekasi.
                        </p>
                        <p class="text-lg text-gray-700 leading-relaxed">
                            Melalui OneInfo.id, kamu bisa menemukan program, lomba, dan prestasi terbaru secara cepat dan terorganisir. Website ini hadir untuk menjadi sumber informasi terpercaya dan inspiratif bagi seluruh warga sekolah.
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
                <a href="#" class="bg-[#ffc436] text-[#0C356A] px-10 py-4 rounded-full font-bold text-lg shadow-lg btn-hover-scale inline-block">
                    Daftar Sekarang
                </a>
                <a href="#" class="border-2 border-white text-white px-10 py-4 rounded-full font-bold text-lg hover:bg-white hover:text-[#0C356A] transition-all duration-300 inline-block">
                    Hubungi Kami
                </a>
            </div>
        </div>
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