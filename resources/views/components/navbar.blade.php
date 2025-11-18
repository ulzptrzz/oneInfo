<div>
    <style>
        /* Navbar Styles */
        .navbar-glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .navbar-scrolled {
            box-shadow: 0 4px 20px rgba(12, 53, 106, 0.1);
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }

        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            width: 0;
            height: 3px;
            bottom: -5px;
            left: 50%;
            background: #ffc436;
            transition: all 0.3s ease;
            transform: translateX(-50%);
            border-radius: 2px;
        }

        .nav-link:hover::before,
        .nav-link.active::before {
            width: 100%;
        }

        .nav-link:hover {
            color: #ffc436;
            transform: translateY(-2px);
        }

        .login-btn {
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(255, 196, 54, 0.3);
        }

        .login-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(255, 196, 54, 0.4);
        }

        /* Mobile Menu */
        .mobile-menu {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            transform-origin: top;
        }

        .mobile-menu-hidden {
            opacity: 0;
            transform: scaleY(0);
            max-height: 0;
        }

        .mobile-menu-visible {
            opacity: 1;
            transform: scaleY(1);
            max-height: 500px;
        }

        .hamburger {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .hamburger:hover {
            transform: scale(1.1);
        }

        .hamburger span {
            display: block;
            width: 28px;
            height: 3px;
            background: #0C356A;
            margin: 5px 0;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .hamburger.active span:nth-child(1) {
            transform: rotate(45deg) translate(8px, 8px);
            background: #ffc436;
        }

        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }

        .hamburger.active span:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -7px);
            background: #ffc436;
        }

        .logo-bounce {
            animation: logoBounce 2s ease-in-out infinite;
        }

        @keyframes logoBounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-5px);
            }
        }

        .mobile-nav-link {
            transition: all 0.3s ease;
        }

        .mobile-nav-link:hover {
            background: rgba(255, 196, 54, 0.1);
            transform: translateX(10px);
        }
    </style>

    <nav class="navbar-glass fixed top-0 left-0 right-0 z-50 py-4 px-6" id="navbar">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            {{-- Logo --}}
            <div class="flex gap-3 items-center">
                <img class="w-14 h-14 logo-bounce" src="{{ asset('assets/logo-smk.png') }}" alt="logo-smk">
                <a href="#beranda" class="font-bold text-2xl">
                    <span class="text-[#ffc436]">One</span><span class="text-[#0C356A]">Info</span><span
                        class="text-[#ffc436]">.id</span>
                </a>
            </div>

            {{-- Desktop Menu --}}
            <div class="hidden lg:flex items-center space-x-1">
                <a href="{{ route('home') }}" class="nav-link px-4 py-2 font-medium text-[#0C356A] active">
                    Beranda
                </a>
                <a href="{{ route('list-program') }}" class="nav-link px-4 py-2 font-medium text-[#0C356A]">
                    Program
                </a>
                <a href="{{ route('list-prestasi') }}" class="nav-link px-4 py-2 font-medium text-[#0C356A]">
                    Prestasi
                </a>
                <a href="{{ route('list-artikel') }}" class="nav-link px-4 py-2 font-medium text-[#0C356A]">
                    Artikel
                </a>
                <a href="{{ route('list-tentang') }}" class="nav-link px-4 py-2 font-medium text-[#0C356A]">
                    Tentang
                </a>

                @auth
                    @if (auth()->user()->role_id == 1)
                        <a href="{{ route('superadmin.dashboard') }}"
                            class="login-btn px-6 py-2.5 bg-[#0C356A] text-white font-bold rounded-full inline-flex items-center gap-2 hover:bg-[#082d5b]">
                            Dashboard
                        </a>
                    @elseif(auth()->user()->role_id == 2)
                        <a href="{{ route('admin.dashboard') }}"
                            class="login-btn px-6 py-2.5 bg-[#0C356A] text-white font-bold rounded-full inline-flex items-center gap-2 hover:bg-[#082d5b]">
                            Dashboard
                        </a>
                    @elseif(auth()->user()->role_id == 3)
                        <a href="{{ route('siswa.dashboard') }}"
                            class="login-btn px-6 py-2.5 bg-[#0C356A] text-white font-bold rounded-full inline-flex items-center gap-2 hover:bg-[#082d5b]">
                            Dashboard
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}"
                        class="login-btn ml-4 px-6 py-2.5 bg-[#ffc436] text-[#0C356A] font-bold rounded-full inline-flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Login
                    </a>
                @endauth

            </div>

            {{-- Mobile Menu Button --}}
            <div class="lg:hidden">
                <button class="hamburger" id="hamburger" onclick="toggleMobileMenu()">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div class="mobile-menu mobile-menu-hidden lg:hidden mt-4 bg-white rounded-2xl shadow-xl overflow-hidden"
            id="mobileMenu">
            <div class="py-4">
                <a href="#beranda"
                    class="mobile-nav-link block px-6 py-3 font-medium text-[#0C356A] border-l-4 border-transparent hover:border-[#ffc436]">
                    🏠 Beranda
                </a>
                <a href="#program"
                    class="mobile-nav-link block px-6 py-3 font-medium text-[#0C356A] border-l-4 border-transparent hover:border-[#ffc436]">
                    📚 Program
                </a>
                <a href="#prestasi"
                    class="mobile-nav-link block px-6 py-3 font-medium text-[#0C356A] border-l-4 border-transparent hover:border-[#ffc436]">
                    🏆 Prestasi
                </a>
                <a href="#artikel"
                    class="mobile-nav-link block px-6 py-3 font-medium text-[#0C356A] border-l-4 border-transparent hover:border-[#ffc436]">
                    📰 Artikel
                </a>
                <a href="#tentang"
                    class="mobile-nav-link block px-6 py-3 font-medium text-[#0C356A] border-l-4 border-transparent hover:border-[#ffc436]">
                    ℹ️ Tentang
                </a>

                {{-- Mobile Login Button --}}
                <div class="px-6 py-3">
                    <a href="/auth/login"
                        class="block text-center px-6 py-3 bg-[#ffc436] text-[#0C356A] font-bold rounded-full">
                        🔐 Login
                    </a>
                </div>
            </div>
        </div>
    </nav>

    {{-- Spacer to prevent content from going under fixed navbar --}}
    <div class="h-20"></div>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        });

        // Mobile menu toggle
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            const hamburger = document.getElementById('hamburger');

            hamburger.classList.toggle('active');

            if (mobileMenu.classList.contains('mobile-menu-hidden')) {
                mobileMenu.classList.remove('mobile-menu-hidden');
                mobileMenu.classList.add('mobile-menu-visible');
            } else {
                mobileMenu.classList.remove('mobile-menu-visible');
                mobileMenu.classList.add('mobile-menu-hidden');
            }
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const mobileMenu = document.getElementById('mobileMenu');
            const hamburger = document.getElementById('hamburger');
            const navbar = document.getElementById('navbar');

            if (!navbar.contains(event.target) && mobileMenu.classList.contains('mobile-menu-visible')) {
                mobileMenu.classList.remove('mobile-menu-visible');
                mobileMenu.classList.add('mobile-menu-hidden');
                hamburger.classList.remove('active');
            }
        });

        // Close mobile menu when clicking a link
        document.querySelectorAll('.mobile-nav-link').forEach(link => {
            link.addEventListener('click', function() {
                const mobileMenu = document.getElementById('mobileMenu');
                const hamburger = document.getElementById('hamburger');

                mobileMenu.classList.remove('mobile-menu-visible');
                mobileMenu.classList.add('mobile-menu-hidden');
                hamburger.classList.remove('active');
            });
        });

        // Active link highlighting based on scroll position
        window.addEventListener('scroll', function() {
            const sections = ['beranda', 'program', 'prestasi', 'artikel', 'tentang'];
            const navLinks = document.querySelectorAll('.nav-link');

            let current = '';

            sections.forEach(section => {
                const element = document.getElementById(section);
                if (element) {
                    const rect = element.getBoundingClientRect();
                    if (rect.top <= 100 && rect.bottom >= 100) {
                        current = section;
                    }
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' + current) {
                    link.classList.add('active');
                }
            });
        });

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const navbarHeight = document.getElementById('navbar').offsetHeight;
                    const targetPosition = target.offsetTop - navbarHeight;

                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</div>
