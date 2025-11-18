@props(['program'])

<div class="max-w-6xl mx-auto px-6 py-12">
    <h2 class="text-4xl md:text-5xl font-bold text-[#0C356A] mb-4">
        Katalog <span class="text-[#ffc436]">Program</span>
    </h2>
    <p class="text-lg text-center text-gray-600 mb-10"> Lihat berbagai program menarik yang didukung oleh SMKN 1 Kota
        Bekasi </p>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
        @foreach ($program as $item)
            <div class="bg-white relative rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                <img src="{{ asset('storage/' . $item->poster) }}" alt="{{ $item->name }}"
                    class="w-full h-64 object-cover">

                <div class="p-4 text-center">
                    <h3 class="text-lg font-semibold text-[#0C356A]"> {{ $item->name }} </h3>
                    <p class="text-sm text-gray-500 mt-1"> {{ $item->kategoriProgram->nama_kategori ?? '-' }} </p>
                </div>
                <a href="{{ route('detail-program', $item->id) }}"
                    class="inline-block mt-3 text-blue-600 font-semibold hover:underline">
                    Lihat Detail →
                </a>
                <livewire:siswa.program.bookmark-toggle :program-id="$item->id" :key="'bookmark-' . $item->id" />

            </div>
        @endforeach
    </div>
    <div class="text-center mt-10"> <a href="{{ route('list-program') }}"
            class="bg-[#0C356A] text-white px-6 py-3 rounded-lg text-lg font-semibold hover:bg-[#082954] transition">
            Lihat Lebih Banyak </a> </div>
</div>
