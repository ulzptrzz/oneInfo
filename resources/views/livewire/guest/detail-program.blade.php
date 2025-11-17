<div class="max-w-4xl mx-auto p-6">

    <a href="{{ route('list-program') }}" class="text-blue-600 hover:underline mb-4 inline-block">
        ← Kembali
    </a>

    <div class="bg-white shadow-lg rounded-xl p-6">

        <img src="{{ asset('storage/' . $program->poster) }}" class="rounded-xl w-full h-64 object-cover mb-6">

        <h1 class="text-3xl font-bold">{{ $program->name }}</h1>

        <p class="text-gray-500 mt-1">{{ $program->kategoriProgram->nama_kategori }}</p>

        <p class="text-gray-600 mt-3 leading-relaxed">
            {{ $program->deskripsi_singkat }}
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
            <div class="grid grid-cols-2 gap-4">
                <a href="{{ route('join-program', $program->id) }}"
                    class="flex items-center gap-1 bg-[#0C356A] text-white px-3 py-2 rounded-md hover:bg-[#082d5b] transition">
                    <i class='bx bx-plus'></i> Admin
                </a>
            </div>
        </div>

    </div>
</div>
