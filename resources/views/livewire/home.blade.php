<div>
    <header class="text-white mx-7">
        <x-navbar />
        {{-- HERO SECTION --}}
        <div class="max-w-6xl mx-auto flex bg-[#0C356A] rounded-xl px-10 pt-10">
            <div class="py-20">
                <h1 class="flex text-4xl md:text-5xl font-extrabold">Jelajahi berbagai program dan lomba menarik di <span class="text-[#ffc436]">OneInfo</span>!</h1>
                <p class="mt-4 text-lg">Website pusat informasi SMKN 1 Kota Bekasi mengenai berbagai program, lomba, dan kursus untuk pelajar berprestasi</p>
                <button class="bg-[#ffc436] text-[#0C356A] p-2 rounded-lg font-semibold text-lg mt-7">Lihat Program</button>
            </div>

            <div>
                <img class="max-w-6xl" src="{{ asset('assets/gambar-hero.png') }}" alt="gambar-hero">
            </div>
        </div>
    </header>

    {{-- KATALOG LOOMBA --}}
    <div class="container items-center m-7">
        <h2 class="text-3xl text-center font-semibold text-[#0C356A] md-20">Katalog Program</h2>
        <p class="mt-4 text-lg text-center text-gray-700 mb-4">Lihat berbagai program menarik yang didukung oleh SMKN 1 Kota Bekasi</p>
        <div class="flex">
            <div class="flex">
                <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                    <img src="{{ asset('assets/FLS3N.png') }}" alt="foto-poster" class="w-full h-48 object-cover">
                    <h2 class="text-lg font-semibold mb-2 text-gray-600">Lomba FLS2N</h2>
                    <p>Ayo berinovasi dan ciptakan solusi untuk masa depan!</p>
                </div>

                <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                    <img src="" alt="{{ asset('assets/pertukaranPelajar.png') }}">
                    <h2 class="text-lg font-semibold mb-2 text-gray-600">Pertukaran Pelajar Luar Negeri</h2>
                    <p>Ayo berinovasi dan ciptakan solusi untuk masa depan!</p>
                </div>

                <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                    <img src="{{ asset('assets/TOEIC.png') }}" alt="">
                    <h2 class="text-lg font-semibold mb-2 text-gray-600">Program Tes TOEIC</h2>
                    <p>Ayo berinovasi dan ciptakan solusi untuk masa depan!</p>
                </div>

                <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                    <img src="{{ asset('assets/FLS3N.png') }}" alt="">
                    <h2 class="text-lg font-semibold mb-2 text-gray-600">Lomba FLS2N</h2>
                    <p>Ayo berinovasi dan ciptakan solusi untuk masa depan!</p>
                </div>
            </div>
        </div>
    </div>

    {{-- SECTION PRESTASI --}}
    <div class="container items-center m-7">
        <h2 class="text-3xl text-center font-semibold text-[#0C356A] md-20">Prestasi Siswa</h2>
        <p class="mt-4 text-lg text-center text-gray-700 mb-4">SMKN 1 Kota Bekasi terus melahirkan generasi berprestasi yang unggul di berbagai bidang</p>

        <div class="flex grid-cols-4">
            <div class="bg-white shadow-lg rounded-2xl overflow-hidden position-relative">
                <img class="w-full h-48 object-cover" src="{{ asset('assets/TOEIC.png') }}" alt="">
                <div class="position-absoulute p-5 rounded-xl shadow-lg">
                    <h3 class="text-lg font-semibold text-[#0C356A]">Mathilda Anneke Waworuntu</h3>
                    <p class="text-gray-700">Juara 2 Runner Up Harvard Essay Competition</p>
                </div>
            </div>

            <div class="bg-white shadow-lg rounded-2xl overflow-hidden position-relative">
                <img class="w-full h-48 object-cover" src="{{ asset('assets/TOEIC.png') }}" alt="">
                <div class="position-absoulute p-5 rounded-xl shadow-lg">
                    <h3 class="text-lg font-semibold text-[#0C356A]">Mathilda Anneke Waworuntu</h3>
                    <p class="text-gray-700">Juara 2 Runner Up Harvard Essay Competition</p>
                </div>
            </div>

            <div class="bg-white shadow-lg rounded-2xl overflow-hidden position-relative">
                <img class="w-full h-48 object-cover" src="{{ asset('assets/TOEIC.png') }}" alt="">
                <div class="position-absoulute p-5 rounded-xl shadow-lg">
                    <h3 class="text-lg font-semibold text-[#0C356A]">Mathilda Anneke Waworuntu</h3>
                    <p class="text-gray-700">Juara 2 Runner Up Harvard Essay Competition</p>
                </div>
            </div>

            <div class="bg-white shadow-lg rounded-2xl overflow-hidden relative">
                <img class="w-full h-48 object-cover" src="{{ asset('assets/TOEIC.png') }}" alt="">
                <div class="absoulute p-5 rounded-xl shadow-lg">
                    <h3 class="text-lg font-semibold text-[#0C356A]">Mathilda Anneke Waworuntu</h3>
                    <p class="text-gray-700">Juara 2 Runner Up Harvard Essay Competition</p>
                </div>
            </div>
        </div>
    </div>

    {{-- SECTION ARTICLE --}}
    <div class="max-w-5xl mx-auto my-12 px-6">
        <h2 class="text-3xl text-center font-semibold text-[#0C356A] mb-2">Artikel</h2>
        <p class="text-lg text-center text-gray-600 mb-8">
            SMKN 1 Kota Bekasi terus melahirkan generasi berprestasi yang unggul di berbagai bidang
        </p>

        <div class="overflow-hidden flex flex-col md:flex-row gap-8 items-start">
            <img src="{{ asset('assets/foto-artikel.jpg') }}" alt="foto-artikel" class="w-full md:w-1/2 h-64 object-cover rounded-xl">
            
            <div class="bg-white shadow-md p-6 flex flex-col justify-center md:w-1/2 pb-14">
                <h3 class="text-2xl font-semibold text-gray-800 mb-1">Title of the Risen Event</h3>
                <p class="text-gray-500 text-sm mb-2">
                    1015 California Ave, Los Angeles CA <br>
                    <span class="text-gray-600">7:00 pm — 8:00 pm</span>
                </p>
                <p class="text-gray-600 mb-4">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam dignissim eu turpis non hendrerit. Nunc nec luctus tellus.
                </p>
                <a href="#" class="text-[#0C356A] font-semibold inline-flex items-center hover:underline">
                    View Event Details
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
    </div>


    {{-- SECTION DOKUMENTASI --}}
    <div class="container items-center m-7">
        <h2 class="text-3xl text-center font-semibold text-[#0C356A] md-20">Dokumentasi</h2>
        <p class="mt-4 text-lg text-center text-gray-700 mb-4">SMKN 1 Kota Bekasi terus melahirkan generasi berprestasi yang unggul di berbagai bidang</p>

        <div class="bg-white shadow-lg rounded-2xl overflow-hidden relative">
            <img class="max-w-5xl object-cover" src="{{ asset('assets/TOEIC.png') }}" alt="">
            <div class="absoulute p-5 rounded-xl shadow-lg">
                <h3 class="text-lg font-semibold text-[#0C356A]">Mathilda Anneke Waworuntu</h3>
                <p class="text-gray-700">Juara 2 Runner Up Harvard Essay Competition</p>
            </div>
        </div>
    </div>

    {{-- SECTION TENTANG --}}
    <div class="container max-w-6xl mx-auto items-center m-7 justify-between text-center bg-white p-10 rounded-xl">
        <div class="flex">
            <img src="{{ asset('assets/logo-smk.png') }}" alt="">
            <div class="justify">
                <h2 class="text-3xl text-center font-bold text-[#0C356A] md-20">Tentang <span class="text-[#ffc436]"> OneInfo.id</span></h2>
                <p class="font- text-lg">
                    OneInfo.id adalah platform informasi sekolah yang dirancang
                    untuk memudahkan siswa, guru, dan masyarakat dalam mengakses
                    berbagai kegiatan di SMKN 1 Kota Bekasi

                    <br>

                    Melalui OneInfo.id, kamu bisa menemukan program, lomba, dan
                    prestasi terbaru secara cepat dan terorganisir. Website ini
                    hadir untuk menjadi sumber informasi terpercaya dan inspiratif
                    bagi seluruh warga sekolah
                </p>
            </div>
        </div>
    </div>

    {{-- SECTION FOOTER --}}
    <x-footer />
</div>