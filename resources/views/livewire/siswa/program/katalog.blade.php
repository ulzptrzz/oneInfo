@props(['program'])

<div class="max-w-6xl mx-auto p-6">

    <h1 class="text-3xl font-bold mb-6">Katalog Program</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        @foreach ($program as $item)
        <div class="bg-white shadow rounded-xl overflow-hidden hover:shadow-lg transition">

            <img src="{{ asset('storage/' . $item->poster) }}"
                 class="w-full h-48 object-cover">

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

                <a href="{{ route('katalog-detail', $item->id) }}"
                   class="inline-block mt-3 text-blue-600 font-semibold hover:underline">
                    Lihat Detail →
                </a>
            </div>

        </div>
        @endforeach

    </div>

</div>
