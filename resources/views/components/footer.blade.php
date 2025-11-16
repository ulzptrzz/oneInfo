<div>
    <style>
        .footer-link {
            transition: all 0.3s ease;
            position: relative;
            display: inline-block;
        }

        .footer-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background-color: #ffc436;
            transition: width 0.3s ease;
        }

        .footer-link:hover::after {
            width: 100%;
        }

        .social-icon {
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            transform: translateY(-5px) scale(1.1);
        }

        .map-container {
            border: 3px solid rgba(255, 196, 54, 0.3);
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .map-container:hover {
            border-color: #ffc436;
            box-shadow: 0 8px 20px rgba(255, 196, 54, 0.3);
        }

        .footer-gradient {
            background: linear-gradient(135deg, #0a2d52 0%, #0C356A 50%, #0e3a6f 100%);
        }

        .contact-item {
            transition: all 0.3s ease;
            padding: 8px;
            border-radius: 8px;
        }

        .contact-item:hover {
            background: rgba(255, 196, 54, 0.1);
            transform: translateX(5px);
        }

        .footer-heading {
            position: relative;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .footer-heading::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 40px;
            height: 3px;
            background: #ffc436;
            border-radius: 2px;
        }
    </style>

    <footer class="footer-gradient text-white py-16 px-6 relative overflow-hidden">
        {{-- Decorative Elements --}}
        <div class="absolute w-96 h-96 bg-[#ffc436] opacity-5 rounded-full -top-40 -right-20"></div>
        <div class="absolute w-80 h-80 bg-[#ffc436] opacity-5 rounded-full -bottom-40 -left-20"></div>

        <div class="max-w-7xl mx-auto relative z-10">
            {{-- Main Footer Content --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-12">
                
                {{-- School Info --}}
                <div>
                    <div class="flex items-center gap-3 mb-5">
                        <img class="w-14 h-14 object-contain" src="{{ asset('assets/logo-smk.png') }}" alt="logo-smk">
                        <div>
                            <h5 class="font-bold text-lg text-[#ffc436]">OneInfo.id</h5>
                            <p class="text-xs opacity-80">SMKN 1 Kota Bekasi</p>
                        </div>
                    </div>
                    <p class="text-sm mb-4 leading-relaxed opacity-90">
                        Platform informasi sekolah yang dirancang untuk memudahkan akses berbagai kegiatan di SMKN 1 Kota Bekasi
                    </p>
                    <p class="text-sm mb-4 leading-relaxed opacity-90">
                        📍 Jl. Bintara VIII No.2, Bintara, Bekasi Barat, Jawa Barat 17134
                    </p>
                    <div class="map-container">
                        <iframe 
                            class="w-full h-36" 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.1234567890!2d106.9876543!3d-6.2345678!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTQnMDQuNCJTIDEwNsKwNTknMTUuNiJF!5e0!3m2!1sen!2sid!4v1234567890"
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>
                    </div>
                </div>

                {{-- Pages Links --}}
                <div>
                    <h6 class="footer-heading text-[#ffc436] font-bold text-lg">Pages</h6>
                    <ul class="space-y-3">
                        <li>
                            <a href="#beranda" class="footer-link text-sm hover:text-[#ffc436] opacity-90 hover:opacity-100">
                                → Beranda
                            </a>
                        </li>
                        <li>
                            <a href="#program" class="footer-link text-sm hover:text-[#ffc436] opacity-90 hover:opacity-100">
                                → Program Sekolah
                            </a>
                        </li>
                        <li>
                            <a href="#prestasi" class="footer-link text-sm hover:text-[#ffc436] opacity-90 hover:opacity-100">
                                → Prestasi
                            </a>
                        </li>
                        <li>
                            <a href="#artikel" class="footer-link text-sm hover:text-[#ffc436] opacity-90 hover:opacity-100">
                                → Artikel
                            </a>
                        </li>
                        <li>
                            <a href="#tentang" class="footer-link text-sm hover:text-[#ffc436] opacity-90 hover:opacity-100">
                                → Tentang Kami
                            </a>
                        </li>
                        <li>
                            <a href="#" class="footer-link text-sm hover:text-[#ffc436] opacity-90 hover:opacity-100">
                                → PPDB 2025
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- Social Media --}}
                <div>
                    <h6 class="footer-heading text-[#ffc436] font-bold text-lg">Social Media</h6>
                    <p class="text-sm mb-5 opacity-80">Ikuti kami di media sosial untuk update terbaru</p>
                    
                    <div class="space-y-3">
                        <a href="https://instagram.com/smkn1kbs" target="_blank" class="flex items-center gap-3 text-sm hover:text-[#ffc436] transition-all contact-item">
                            <div class="social-icon w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold">Instagram</p>
                                <p class="text-xs opacity-70">@smkn1kbs</p>
                            </div>
                        </a>

                        <a href="https://facebook.com/smkn1kotabekasi" target="_blank" class="flex items-center gap-3 text-sm hover:text-[#ffc436] transition-all contact-item">
                            <div class="social-icon w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold">Facebook</p>
                                <p class="text-xs opacity-70">SMKN 1 Kota Bekasi</p>
                            </div>
                        </a>

                        <a href="https://youtube.com/@smkn1kotabekasi" target="_blank" class="flex items-center gap-3 text-sm hover:text-[#ffc436] transition-all contact-item">
                            <div class="social-icon w-10 h-10 bg-red-600 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold">YouTube</p>
                                <p class="text-xs opacity-70">SMKN 1 Kota Bekasi</p>
                            </div>
                        </a>
                    </div>
                </div>

                {{-- Contact --}}
                <div>
                    <h6 class="footer-heading text-[#ffc436] font-bold text-lg">Contact</h6>
                    <p class="text-sm mb-5 opacity-80">Hubungi kami untuk informasi lebih lanjut</p>
                    
                    <div class="space-y-3">
                        <a href="tel:02188951151" class="flex items-center gap-3 text-sm hover:text-[#ffc436] transition-all contact-item">
                            <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold">Telepon</p>
                                <p class="text-xs opacity-70">(021) 88951151</p>
                            </div>
                        </a>

                        <a href="mailto:info@smkn1kotabekasi.sch.id" class="flex items-center gap-3 text-sm hover:text-[#ffc436] transition-all contact-item">
                            <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-red-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold">Email</p>
                                <p class="text-xs opacity-70 break-all">info@smkn1kotabekasi.sch.id</p>
                            </div>
                        </a>

                        <a href="https://www.smkn1kotabekasi.sch.id" target="_blank" class="flex items-center gap-3 text-sm hover:text-[#ffc436] transition-all contact-item">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold">Website</p>
                                <p class="text-xs opacity-70">smkn1kotabekasi.sch.id</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Divider --}}
            <div class="border-t border-gray-600 border-opacity-30 mb-8"></div>

            {{-- Bottom Footer --}}
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-sm opacity-80 text-center md:text-left">
                    © {{ date('Y') }} <span class="text-[#ffc436] font-semibold">OneInfo.id</span> | SMKN 1 Kota Bekasi - All Rights Reserved
                </p>
                
                <div class="flex gap-6 text-xs opacity-70">
                    <a href="#" class="hover:text-[#ffc436] transition-colors">Privacy Policy</a>
                    <span>•</span>
                    <a href="#" class="hover:text-[#ffc436] transition-colors">Terms of Service</a>
                    <span>•</span>
                    <a href="#" class="hover:text-[#ffc436] transition-colors">Sitemap</a>
                </div>
            </div>

            {{-- Back to Top Button --}}
            <div class="mt-8 text-center">
                <a href="#" onclick="window.scrollTo({top: 0, behavior: 'smooth'}); return false;" 
                   class="inline-flex items-center gap-2 bg-[#ffc436] text-[#0C356A] px-6 py-3 rounded-full font-semibold text-sm hover:bg-yellow-400 transition-all transform hover:-translate-y-1 hover:shadow-lg">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                    </svg>
                    Back to Top
                </a>
            </div>
        </div>
    </footer>
</div>