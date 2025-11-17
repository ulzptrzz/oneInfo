@props(['item'])

<div class="bg-white relative rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300">

    <img
        src="{{ asset('storage/' . $item->poster) }}"
        alt="{{ $item->name }}"
        class="w-full h-64 object-cover">

    <div class="p-4 text-center">
        <h3 class="text-lg font-semibold text-[#0C356A]">
            {{ $item->name }}
        </h3>

        <p class="text-sm text-gray-500 mt-1">
            {{ $item->kategoriProgram->nama_kategori ?? '-' }}
        </p>
    </div>
    <a href="{{ route('detail-program', $item->id) }}"
        class="inline-block mt-3 text-blue-600 font-semibold hover:underline">
        Lihat Detail →
    </a>
    {{-- Toggle Bookmark --}}
    <div class="absolute top-3 right-3">
        <livewire:siswa.program.bookmark-toggle
            :program-id="$item->id"
            :key="'bookmark-'.$item->id" />
    </div>

</div>