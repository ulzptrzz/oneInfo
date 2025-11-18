@php
    use Carbon\Carbon;

    $tanggalArtikel = Carbon::parse($artikel->tanggal)->translatedFormat('d F Y');

    $statusColor = match ($artikel->status) {
        'publish' => 'bg-green-500',
        'draft' => 'bg-yellow-400',
        default => 'bg-gray-400',
    };
@endphp

<div class="flex min-h-screen">

    <div class="w-full mx-10 mt-10 bg-white rounded-2xl shadow-md overflow-hidden">

        {{-- Header --}}
        <div class="bg-[#0C356A] text-white px-6 py-5">
            <h2 class="text-2xl font-semibold">{{ $artikel->judul }}</h2>

            <span class="inline-block mt-3 px-3 py-1 text-xs font-semibold text-white rounded-full {{ $statusColor }}">
                {{ ucfirst($artikel->status) }}
            </span>
        </div>

        {{-- Konten Utama --}}
        <div class="p-8">

            {{-- Grid Detail --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                {{-- Thumbnail --}}
                <div>
                    <p class="text-sm font-semibold text-gray-600 mb-2">Thumbnail</p>

                    @if ($artikel->thumbnail)
                        <img
                            src="{{ asset('storage/' . $artikel->thumbnail) }}"
                            alt="thumbnail"
                            class="rounded-lg w-full object-cover shadow-md"
                        >
                    @else
                        <div class="h-48 w-full flex items-center justify-center bg-gray-100 rounded-lg text-gray-500">
                            Tidak ada thumbnail
                        </div>
                    @endif
                </div>

                {{-- Detail --}}
                <div class="md:col-span-2 space-y-6">

                    {{-- Tanggal --}}
                    <div>
                        <p class="text-sm font-semibold text-gray-600">Tanggal Artikel</p>
                        <p class="text-gray-800 font-medium mt-1">{{ $tanggalArtikel }}</p>
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <p class="text-sm font-semibold text-gray-600">Deskripsi</p>
                        <p class="text-gray-800 mt-1 leading-relaxed">
                            {{ $artikel->deskripsi ?? '-' }}
                        </p>
                    </div>

                    {{-- Konten --}}
                    <div>
                        <p class="text-sm font-semibold text-gray-600">Konten Artikel</p>
                        <div class="text-gray-800 leading-relaxed mt-2">
                            {!! nl2br(e($artikel->konten)) !!}
                        </div>
                    </div>

                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex justify-end gap-3 pt-6 border-t border-gray-200 mt-8">

                <a href="{{ route('admin.artikel') }}"
                    class="px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition">
                    Kembali
                </a>

                <a href="{{ route('edit-artikel', $artikel->id) }}"
                    class="px-6 py-3 bg-[#FFC436] text-[#0C356A] font-bold rounded-lg hover:bg-yellow-400 transition">
                    Edit Artikel
                </a>

            </div>

        </div>
    </div>
</div>
