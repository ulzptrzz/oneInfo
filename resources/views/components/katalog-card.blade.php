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
    

</div>

@props(['item'])

@php
use Carbon\Carbon;

$tanggalMulai = Carbon::parse($item->tanggal_mulai)->translatedFormat('d F Y');
$tanggalSelesai = Carbon::parse($item->tanggal_selesai)->translatedFormat('d F Y');
@endphp

<div class="flex min-h-screen">
    <div class="w-full mx-10 mt-10">
        {{-- Card Utama --}}
        <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-200">

            {{-- Header --}}
            <div class="bg-[#0C356A] text-white px-6 py-5 flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-semibold">{{ $item->name }}</h2>
                </div>
            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Poster --}}
                <div class="md:col-span-1">
                    <img
                        src="{{ asset('storage/' . $item->poster) }}"
                        alt="poster"
                        class="rounded-lg w-full object-cover shadow-lg">
                </div>

                {{-- Detail --}}
                <div class="md:col-span-2 space-y-6">

                    {{-- Kategori --}}
                    <div>
                        <p class="text-gray-500 font-semibold text-sm">Kategori Program</p>
                        <p class="text-gray-900 text-lg">
                            {{ $item->kategoriProgram->nama_kategori }}
                        </p>
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <p class="text-gray-500 font-semibold text-sm">Deskripsi</p>
                        <p class="text-gray-800 leading-relaxed">
                            {{ $item->deskripsi }}
                        </p>
                    </div>

                    {{-- Tanggal --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-500 font-semibold text-sm">Tanggal Mulai</p>
                            <p class="font-medium">{{ $tanggalMulai }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500 font-semibold text-sm">Tanggal Selesai</p>
                            <p class="font-medium">{{ $tanggalSelesai }}</p>
                        </div>
                    </div>

                    {{-- Penyelenggara --}}
                    <div>
                        <p class="text-gray-500 font-semibold text-sm">Penyelenggara</p>
                        @foreach (json_decode($item->penyelenggara, true) as $pg)
                        <span>{{ $pg }}</span>
                        @endforeach
                    </div>

                    {{-- Tingkat & Lomba --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-500 font-semibold text-sm">Tingkat</p>
                            <p>{{ $item->tingkat }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500 font-semibold text-sm">Mata Lomba</p>
                            @foreach (json_decode($item->mata_lomba, true) as $ml)
                            <span>{{ $ml }}</span>
                            @endforeach
                        </div>
                        <div>
                            <p class="text-gray-500 font-semibold text-sm">Pelaksanaan</p>
                            <p>{{ $item->pelaksanaan }}</p>

                        </div>
                    </div>

                    {{-- Link Pendaftaran --}}
                    <div>
                        <p class="text-gray-500 font-semibold text-sm mb-1">Link Pendaftaran</p>

                        @if ($item->link_pendaftaran)
                        <a href="{{ $item->link_pendaftaran }}" target="_blank"
                            class="text-blue-600 underline">
                            Buka Link Pendaftaran
                        </a>
                        @else
                        <p class="text-gray-400 italic">Tidak ada link pendaftaran</p>
                        @endif
                    </div>


                    <div>
                        <p class="text-gray-500 font-semibold text-sm mb-1">Panduan Lomba</p>

                        @if(Str::contains($item->panduan_lomba, '.pdf'))
                        <a href="{{ asset('storage/' . $item->panduan_lomba) }}" target="_blank">
                            Download Panduan PDF
                        </a>
                        @endif


                        @if(Str::startsWith($item->panduan_lomba, 'http'))
                        <a href="{{ $item->panduan_lomba }}" target="_blank">
                            Lihat Panduan
                        </a>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>