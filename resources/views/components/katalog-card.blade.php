@props(['item'])

<div class="bg-white relative rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300">

    <img src="{{ asset('storage/' . $item->poster) }}" alt="{{ $item->name }}" class="w-full h-64 object-cover">

    <div class="p-6 space-y-4">

        <div class="flex justify-between">
            <h3 class="text-2xl font-bold text-[#0C356A] line-clamp-2 leading-tight">
                {{ $item->name }}
            </h3>
            <span
                class="inline-block px-4 py-1.5 text-xs font-semibold text-indigo-700 bg-indigo-100 rounded-full border border-indigo-200">
                {{ $item->kategoriProgram->nama_kategori ?? 'Umum' }}
            </span>
        </div>


        <p class="text-gray-600 text-sm leading-relaxed line-clamp-3">
            {{ Str::limit(strip_tags($item->deskripsi), 120) }}
        </p>

        <div class="pt-3">
            <a href="{{ route('guest-detail-program', $item->id) }}"
                class="inline-flex items-center gap-2 w-full justify-center px-6 py-3.5 bg-[#0C356A] text-white font-semibold rounded-xl hover:bg-[#0a2b55] transform hover:scale-105 transition-all duration-300 shadow-md hover:shadow-xl">
                <span>Lihat Detail</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>
    {{-- Toggle Bookmark --}}
    <div class="absolute top-3 right-3">
        <livewire:siswa.program.bookmark-toggle :program-id="$item->id" :key="'bookmark-' . $item->id" />
    </div>

</div>
