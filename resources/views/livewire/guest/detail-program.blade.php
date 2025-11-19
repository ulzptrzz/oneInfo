<div class="max-w-4xl mx-auto p-6">

    <a href="{{ route('list-program') }}" class="text-blue-600 hover:underline mb-4 inline-block">
        ← Kembali
    </a>

    <div class="bg-white shadow-lg rounded-xl p-6">

        <img src="{{ asset('storage/' . $program->poster) }}" class="rounded-xl w-full h-64 object-cover mb-6">

        <h1 class="text-3xl font-bold">{{ $program->name }}</h1>

        <p class="text-gray-500 mt-1">{{ $program->kategoriProgram?->nama_kategori ?? 'Tidak ada kategori' }}</p>

        <p class="text-gray-600 mt-3 leading-relaxed">
            {{ $program->deskripsi }}
        </p>

        <div class="mt-4">
            <p><strong>Tanggal:</strong>
                {{ \Carbon\Carbon::parse($program->tanggal_mulai)->translatedFormat('d F Y') }}
                -
                {{ \Carbon\Carbon::parse($program->tanggal_selesai)->translatedFormat('d F Y') }}
            </p>

            <p><strong>Penyelenggara:</strong> {{ $program->penyelenggara }}</p>
            <p><strong>Tingkat:</strong> {{ $program->tingkat }}</p>
            <p><strong>Mata Lomba:</strong> {{ $program->mata_lomba }}</p>

            
        </div>
        <div class="mt-10">
            @if (!$sudahDaftar)
                <button wire:click="daftar" wire:loading.attr="disabled"
                    class="bg-[#0C356A] text-white px-8 py-4 rounded-lg font-semibold hover:bg-[#082d5b] transition shadow-lg flex items-center gap-3 text-lg">
                    <span wire:loading.remove>Daftar Program</span>
                    <span wire:loading>Sedang mengirim...</span>
                </button>
            @else
                @if ($statusPendaftaran === 'pending')
                    <div
                        class="bg-yellow-100 border border-yellow-400 text-yellow-800 px-6 py-4 rounded-lg inline-block">
                        Menunggu persetujuan admin...
                    </div>
                @elseif($statusPendaftaran === 'approved')
                    <div
                        class="bg-green-100 border border-green-400 text-green-800 px-6 py-4 rounded-lg inline-block font-bold">
                        Selamat! Pendaftaran kamu telah disetujui!
                    </div>
                @elseif($statusPendaftaran === 'rejected')
                    <div class="bg-red-100 border border-red-400 text-red-800 px-6 py-4 rounded-lg inline-block">
                        Maaf, pendaftaran kamu ditolak.
                    </div>
                @endif
            @endif

            @if (session()->has('message'))
                <div
                    class="mt-4 text-sm {{ str_starts_with(session('message'), 'success') ? 'text-green-600' : 'text-red-600' }}">
                    {{ ltrim(session('message'), 'success|error|') }}
                </div>
            @endif

            @if ($message)
                @php $parts = explode('|', $message); @endphp
                <div
                    class="mt-4 p-4 rounded-lg {{ $parts[0] == 'success' ? 'bg-green-100 text-green-700 border border-green-300' : 'bg-red-100 text-red-700 border border-red-300' }}">
                    {{ $parts[1] }}
                </div>
            @endif
        </div>

    </div>
</div>
