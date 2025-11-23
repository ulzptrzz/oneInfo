<div>
    <x-navbar />

    {{-- Minimalist Clean Style --}}
    <section class="py-16 px-6 bg-white min-h-screen">
        <div class="max-w-3xl mx-auto">
            
            {{-- Back Button --}}
            <a href="{{ route('list-artikel') }}"
                class="inline-flex items-center mb-8 gap-2 px-6 mt-5 py-3.5 bg-[#0C356A] text-white font-semibold rounded-xl hover:bg-[#0a2b55] transform hover:scale-105 transition-all duration-300 shadow-md hover:shadow-xl">
                <i class='bx bx-arrow-back text-xl'></i>
                Semua Artikel
            </a>

            {{-- Article --}}
            <article>
                
                {{-- Title --}}
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                    {{ $artikel->judul }}
                </h1>

                {{-- Meta --}}
                <div class="flex items-center gap-4 text-sm text-gray-500 mb-10 pb-10 border-b border-gray-200">
                    <time>{{ \Carbon\Carbon::parse($artikel->tanggal)->format('F d, Y') }}</time>
                    <span>•</span>
                    <span>{{ ceil(str_word_count(strip_tags($artikel->konten ?? '')) / 200) }} min read</span>
                </div>

                {{-- Featured Image --}}
                @if($artikel->thumbnail)
                    <div class="mb-12">
                        <img src="{{ asset('storage/' . $artikel->thumbnail) }}" 
                             alt="{{ $artikel->judul }}"
                             class="w-full h-auto rounded-lg">
                    </div>
                @endif

                {{-- Description --}}
                @if($artikel->deskripsi)
                    <div class="mb-10">
                        <p class="text-xl text-gray-600 leading-relaxed">
                            {{ $artikel->deskripsi }}
                        </p>
                    </div>
                @endif

                {{-- Content --}}
                <div class="prose prose-lg max-w-none">
                    <div class="text-gray-700 leading-loose text-lg">
                        {!! nl2br(e($artikel->konten ?? '')) !!}
                    </div>
                </div>

                {{-- Share --}}
                <div class="mt-16 pt-10 border-t border-gray-200">
                    <p class="text-sm text-gray-500 mb-4">Share this article</p>
                    <div class="flex gap-3">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                           target="_blank"
                           class="text-gray-600 hover:text-blue-600 transition">
                            <i class='bx bxl-facebook-circle text-3xl'></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($artikel->judul) }}" 
                           target="_blank"
                           class="text-gray-600 hover:text-sky-500 transition">
                            <i class='bx bxl-twitter text-3xl'></i>
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($artikel->judul . ' - ' . request()->url()) }}" 
                           target="_blank"
                           class="text-gray-600 hover:text-green-500 transition">
                            <i class='bx bxl-whatsapp text-3xl'></i>
                        </a>
                    </div>
                </div>
            </article>

            {{-- Related --}}
            @if($relatedArtikels->count() > 0)
                <div class="mt-20 pt-10 border-t border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-900 mb-8">More Articles</h2>
                    <div class="space-y-6">
                        @foreach($relatedArtikels as $related)
                            <a href="{{ route('guest.artikel.detail', $related->id) }}" 
                               class="flex gap-6 group">
                                @if($related->thumbnail)
                                    <img src="{{ asset('storage/' . $related->thumbnail) }}" 
                                         class="w-32 h-24 object-cover rounded flex-shrink-0">
                                @endif
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900 group-hover:text-[#0C356A] transition mb-2">
                                        {{ $related->judul }}
                                    </h3>
                                    <p class="text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($related->tanggal)->format('F d, Y') }}
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </section>

    <x-footer />
</div>