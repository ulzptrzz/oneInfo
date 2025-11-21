@props(['program'])

<div class="max-w-6xl mx-auto px-6">
    <h2 class="text-4xl text-center md:text-5xl font-bold text-[#0C356A] mb-4">
        Katalog <span class="text-[#ffc436]">Program</span>
    </h2>
    <p class="text-lg text-center text-gray-600 mb-10"> Lihat berbagai program menarik yang didukung oleh SMKN 1 Kota
        Bekasi </p>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach ($program as $item)
            <div
                class="bg-white relative rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 flex flex-col h-full">
                <!-- Gambar -->
                <img src="{{ asset('storage/' . $item->poster) }}" alt="{{ $item->name }}"
                    class="w-full h-64 object-cover">

                <!-- Content -->
                <div class="p-6 space-y-4 flex flex-col flex-grow">

                    <div class="flex justify-between">
                        <h3 class="text-2xl font-bold text-[#0C356A] line-clamp-2 leading-tight">
                            {{ $item->name }}
                        </h3>
                        <span
                            class="inline-flex justify-center items-center w-28 h-8 text-xs font-bold text-indigo-700 bg-indigo-100 rounded-lg border border-indigo-200 truncate px-2">
                            {{ $item->kategoriProgram->nama_kategori ?? 'Umum' }}
                        </span>
                    </div>

                    <p class="text-gray-600 text-sm leading-relaxed line-clamp-3 flex-grow">
                        {{ Str::limit(strip_tags($item->deskripsi), 120) }}
                    </p>

                    <!-- Tombol -->
                    <div class="pt-3 mt-auto">
                        <a href="{{ route('guest-detail-program', $item->id) }}"
                            class="inline-flex items-center justify-center gap-2 w-full px-6 py-3.5 bg-[#0C356A] text-white font-semibold rounded-xl hover:bg-[#0a2b55] transform hover:scale-105 transition-all duration-300 shadow-md hover:shadow-xl">
                            <span>Lihat Detail</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Bookmark -->
                <div class="absolute top-3 right-3 bg-white p-1 rounded-full shadow-md z-10">
                    <livewire:siswa.program.bookmark-toggle :program-id="$item->id" :key="'bookmark-' . $item->id" />
                </div>
            </div>
        @endforeach
    </div>
    <div class="text-center mt-16">
        <a href="{{ route('list-program') }}"
            class="bg-[#0C356A] text-white px-16 py-5 rounded-lg text-xl font-semibold hover:bg-[#082954] transition">
            Lihat Lebih Banyak </a>
    </div>
</div>
