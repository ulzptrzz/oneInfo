<div>
    <x-navbar />

    {{-- SECTION ARTICLE - Enhanced --}}
    <section id="artikel" class="py-10 px-7 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-6xl mx-auto">
            <div class="text-left mb-16">
                <h3 class="text-4xl text-center font-bold text-[#0C356A] mb-4">
                    Artikel <span class="text-[#ffc436]">Terbaru</span>
                </h3>
            </div>

            {{-- Articles Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($artikels as $artikel)
                    <div
                        class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">

                        {{-- Image --}}
                        <div class="h-48 overflow-hidden">
                            @if ($artikel->thumbnail)
                                <img src="{{ asset('storage/' . $artikel->thumbnail) }}" alt="{{ $artikel->judul }}"
                                    class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                            @else
                                <div
                                    class="w-full h-full bg-gradient-to-br from-[#0C356A] to-[#1e40af] flex items-center justify-center">
                                    <i class='bx bx-image text-white text-6xl opacity-50'></i>
                                </div>
                            @endif
                        </div>

                        {{-- Content --}}
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2">
                                {{ $artikel->judul }}
                            </h3>

                            <p class="text-gray-500 text-sm mb-3 flex items-center gap-1">
                                <i class='bx bx-calendar'></i>
                                {{ \Carbon\Carbon::parse($artikel->tanggal)->format('d F Y') }}
                            </p>

                            <p class="text-gray-600 mb-4 leading-relaxed text-sm line-clamp-3">
                                {{ $artikel->deskripsi ?? Str::limit(strip_tags($artikel->konten ?? ''), 100) }}
                            </p>

                            <a href="{{ route('guest.artikel.detail', $artikel->id) }}"
                                class="text-[#0C356A] font-bold inline-flex items-center hover:text-[#ffc436] transition-colors group">
                                Baca Selengkapnya
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 ml-1 transform group-hover:translate-x-1 transition-transform"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
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
                @endforelse
            </div>
    </section>
    <x-whatsapp />
    <x-footer />
</div>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .line-clamp-3 {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
