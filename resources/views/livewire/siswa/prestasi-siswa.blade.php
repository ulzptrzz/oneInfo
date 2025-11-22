<div class="flex min-h-screen">
    <x-sidebar-siswa active="prestasi" />

    <div class="w-full mx-10 mt-10 mb-10">
        
        {{-- Header Section --}}
        <div class="bg-gradient-to-r from-[#0C356A] to-[#1e40af] rounded-2xl shadow-lg p-8 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-2">
                        Prestasi Saya
                    </h1>
                    <p class="text-blue-100">
                        Daftar prestasi dan program yang telah kamu ikuti
                    </p>
                </div>
                <div class="bg-white/20 backdrop-blur-sm px-6 py-4 rounded-xl">
                    <p class="text-white/80 text-sm">Total Prestasi</p>
                    <p class="text-4xl font-bold text-white">{{ $prestasis->count() }}</p>
                </div>
            </div>
        </div>

        {{-- Prestasi Cards --}}
        @if($prestasis->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($prestasis as $prestasi)
                    <div class="bg-white rounded-xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden">
                        
                        {{-- Header dengan Ribbon --}}
                        <div class="relative bg-gradient-to-br from-[#FFC436] to-yellow-500 p-6">
                            <div class="absolute top-0 right-0">
                                <div class="bg-[#0C356A] text-white px-4 py-2 rounded-bl-2xl shadow-lg">
                                    <i class='bx bx-medal text-xl'></i>
                                </div>
                            </div>
                            <div class="text-[#0C356A]">
                                <p class="text-sm font-medium mb-1">Program</p>
                                <h3 class="text-lg font-bold line-clamp-2">
                                    {{ $prestasi->program->name ?? 'Program Tidak Diketahui' }}
                                </h3>
                            </div>
                        </div>

                        {{-- Content --}}
                        <div class="p-6">
                            {{-- Deskripsi Prestasi --}}
                            <div class="mb-4">
                                <p class="text-sm text-gray-500 mb-2">Deskripsi Prestasi</p>
                                <p class="text-gray-900 font-semibold line-clamp-3">
                                    {{ $prestasi->deskripsi }}
                                </p>
                            </div>

                            {{-- Info Grid --}}
                            <div class="space-y-3">
                                {{-- Tanggal --}}
                                <div class="flex items-center gap-3 text-sm">
                                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <i class='bx bx-calendar text-blue-600 text-lg'></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Tanggal</p>
                                        <p class="font-medium text-gray-900">
                                            {{ \Carbon\Carbon::parse($prestasi->tanggal)->translatedFormat('d F Y') }}
                                        </p>
                                    </div>
                                </div>

                                {{-- Penyelenggara --}}
                                @if($prestasi->program)
                                    <div class="flex items-center gap-3 text-sm">
                                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                            <i class='bx bx-buildings text-purple-600 text-lg'></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs text-gray-500">Penyelenggara</p>
                                            <p class="font-medium text-gray-900 truncate">
                                                {{ $prestasi->program->penyelenggara ?? '-' }}
                                            </p>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            {{-- Badge Status --}}
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                    <i class='bx bx-check-circle'></i>
                                    Prestasi Tercatat
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            {{-- Empty State --}}
            <div class="bg-white rounded-2xl shadow-md p-12">
                <div class="text-center">
                    <div class="w-32 h-32 bg-[#D6EBFF] rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class='bx bx-trophy text-[#0C356A] text-6xl'></i>
                    </div>
                    <h3 class="text-2xl font-bold text-[#0C356A] mb-3">
                        Belum Ada Prestasi
                    </h3>
                    <p class="text-gray-600 mb-6 max-w-md mx-auto">
                        Kamu belum memiliki prestasi yang tercatat. Ikuti berbagai program dan kompetisi untuk mendapatkan prestasi!
                    </p>
                    <div class="inline-flex items-center gap-2 bg-blue-50 text-blue-700 px-4 py-2 rounded-lg">
                        <i class='bx bx-info-circle'></i>
                        <span class="text-sm">Prestasi akan ditambahkan oleh admin sekolah</span>
                    </div>
                </div>
            </div>
        @endif

    </div>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</div>