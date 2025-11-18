<div>
    <x-navbar />

    {{-- SECTION ARTICLE - Enhanced --}}
    <section id="artikel" class="py-10 px-7 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-6xl mx-auto">
            <div class="text-left mb-16">
                <h3 class="text-4xl  font-bold text-[#0C356A] mb-4">
                    Artikel <span class="text-[#ffc436]">Terbaru</span>
                </h3>
            </div>

            {{-- Articles Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($artikels as $artikel)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                        
                        {{-- Image --}}
                        <div class="h-48 overflow-hidden">
                            @if($artikel->thumbnail)
                                <img src="{{ asset('storage/' . $artikel->thumbnail) }}" 
                                     alt="{{ $artikel->judul }}" 
                                     class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-[#0C356A] to-[#1e40af] flex items-center justify-center">
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
                                     fill="none" 
                                     viewBox="0 0 24 24" 
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16">
                        <i class='bx bx-news text-6xl text-gray-300 mb-4'></i>
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Artikel</h3>
                        <p class="text-gray-500">Artikel terbaru akan segera hadir</p>
                    </div>
                @endforelse
            </div>
    </section>
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