@props(['program'])

<div>
    <x-navbar />

    <div class="max-w-6xl mx-auto p-6">

        <h2 class="text-4xl text-center  md:text-5xl font-bold text-[#0C356A] mb-4">
            Katalog <span class="text-[#ffc436]">Program</span>
        </h2>
        <p class="text-lg text-center text-gray-600 mb-10"> Lihat berbagai program menarik yang didukung oleh SMKN 1 Kota
            Bekasi </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            @foreach ($program as $item)
                <div class="bg-white relative shadow rounded-xl overflow-hidden hover:shadow-lg transition">

                    <img src="{{ asset('storage/' . $item->poster) }}" class="w-full h-48 object-cover">

                    <div class="p-4">
                        <h2 class="text-xl font-semibold">{{ $item->name }}</h2>

                        <p class="text-gray-500 text-sm mt-1">
                            {{ $item->kategori->nama_kategori ?? '-' }}
                        </p>

                        <p class="text-gray-500 text-sm mt-1">
                            {{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d F Y') }}
                            –
                            {{ \Carbon\Carbon::parse($item->tanggal_selesai)->translatedFormat('d F Y') }}
                        </p>

                        <a href="{{ route('detail-program', $item->id) }}"
                            class="inline-block mt-3 text-blue-600 font-semibold hover:underline">
                            Lihat Detail →
                        </a>

                        <livewire:siswa.program.bookmark-toggle :program-id="$item->id" :key="'bookmark-' . $item->id" />
                    </div>

                </div>
            @endforeach

        </div>

    </div>
</div>
