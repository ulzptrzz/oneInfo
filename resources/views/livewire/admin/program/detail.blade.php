@php
    use Carbon\Carbon;

    $tanggalMulai = Carbon::parse($program->tanggal_mulai)->translatedFormat('d F Y');
    $tanggalSelesai = Carbon::parse($program->tanggal_selesai)->translatedFormat('d F Y');

    $statusColor = match ($program->status) {
        'published' => 'bg-green-400',
        'draft' => 'bg-yellow-400',
        'archived' => 'bg-red-400',
    };
@endphp

<div class="max-w-5xl mx-auto p-6">

    <div class="text-sm text-gray-500 mb-4 flex items-center gap-2">
        <a href="{{ route('admin.dashboard') }}" class="hover:underline">Dashboard</a>
        <span>/</span>
        <a href="{{ route('admin.program') }}" class="hover:underline">Program</a>
        <span>/</span>
        <span class="font-semibold text-gray-700">Detail Program</span>
    </div>

    <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-200">
        
        <div class="bg-[#0C356A] text-white px-6 py-4 flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-semibold">{{ $program->name }}</h2>

                <span class="inline-block mt-1 px-3 py-1 text-xs font-semibold text-white rounded-full {{ $statusColor }}">
                    {{ ucfirst($program->status) }}
                </span>
            </div>
        </div>

        <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="md:col-span-1">
                <img 
                    src="{{ asset('storage/' . $program->poster) }}" 
                    alt="poster"
                    class="rounded-lg w-full object-cover shadow"
                >
            </div>

            <div class="md:col-span-2 space-y-5">

                <div>
                    <p class="text-gray-500 font-semibold text-sm">Kategori Program</p>
                    <p class="text-gray-900 text-lg">
                        {{ $program->kategori_program_id }} — {{ $program->kategoriProgram->nama_kategori }}
                    </p>
                </div>

                <div>
                    <p class="text-gray-500 font-semibold text-sm">Deskripsi Singkat</p>
                    <p class="text-gray-800 leading-relaxed">{{ $program->deskripsi_singkat }}</p>
                </div>

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

                <div>
                    <p class="text-gray-500 font-semibold text-sm">Penyelenggara</p>
                    <p>{{ $program->penyelenggara }}</p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-500 font-semibold text-sm">Tingkat</p>
                        <p>{{ $program->tingkat }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500 font-semibold text-sm">Mata Lomba</p>
                        <p>{{ $program->mata_lomba }}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
