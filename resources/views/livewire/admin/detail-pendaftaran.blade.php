<div class="flex min-h-screen">
    <x-sidebar />

    <div class="w-full mx-8 my-7 bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="p-6">

            
            <!-- Judul Halaman -->
            <h2 class="text-3xl font-bold text-[#0C356A] mb-8">Detail Pendaftaran</h2>

            <!-- Informasi Siswa & Program (2 kolom) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">

                <!-- Kolom Kiri: Siswa & Bukti Pendaftaran -->
                <div class="space-y-5">

                    <div>
                        <p class="text-sm text-gray-500">Nama Siswa</p>
                        <p class="font-medium text-lg">{{ $pendaftaran->siswa->user->name }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">NIS</p>
                        <p class="font-medium">{{ $pendaftaran->siswa->nis }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Tanggal Daftar</p>
                        <p class="font-medium">
                            {{ \Carbon\Carbon::parse($pendaftaran->tanggal_daftar)->translatedFormat('d F Y') }}
                        </p>
                    </div>

                    <div>
                        <h3 class="font-semibold text-lg mb-3">Bukti Pendaftaran</h3>
                        @if ($pendaftaran->bukti_pendaftaran)
                            @php $bukti = $pendaftaran->bukti_pendaftaran; @endphp

                            <div class="w-48">
                                @if (Str::endsWith($bukti, ['.jpg', '.jpeg', '.png', '.gif']))
                                    <img src="{{ asset('storage/' . $bukti) }}" alt="Bukti pendaftaran"
                                        class="w-full h-40 object-cover rounded-lg border">
                                @else
                                    <div class="p-4 border rounded-lg bg-gray-50 text-center">
                                        <i class="bx bx-file text-4xl text-gray-400"></i>
                                        <p class="mt-2">
                                            <a href="{{ asset('storage/' . $bukti) }}" target="_blank"
                                                class="text-blue-600 hover:underline text-sm">
                                                Lihat / Unduh bukti
                                            </a>
                                        </p>
                                    </div>
                                @endif
                            </div>
                        @else
                            <p class="text-sm text-gray-500">Tidak ada bukti pendaftaran.</p>
                        @endif
                    </div>

                </div>

                <!-- Kolom Kanan: Detail Program -->
                <div class="space-y-5">

                    <div>
                        <p class="text-sm text-gray-500">Program</p>
                        <p class="font-semibold text-xl">{{ $pendaftaran->program->name }}</p>
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-gray-700 mb-2">Penyelenggara</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach (json_decode($pendaftaran->program->penyelenggara, true) ?? [] as $pl)
                                <span
                                    class="px-3 py-1.5 text-xs font-medium text-amber-700 bg-amber-100 rounded-full border border-amber-200">
                                    {{ Str::limit($pl, 30) }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Pelaksanaan</p>
                        <p class="font-medium">{{ ucfirst($pendaftaran->program->pelaksanaan) }}</p>
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-gray-700 mb-2">Mata Lomba</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach (json_decode($pendaftaran->program->mata_lomba, true) ?? [] as $ml)
                                <span
                                    class="px-3 py-1.5 text-xs font-medium text-amber-700 bg-amber-100 rounded-full border border-amber-200">
                                    {{ Str::limit($ml, 30) }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <div class="pt-4">
                        <p class="text-sm text-gray-500">Status Pendaftaran</p>
                        <div class="mt-2">
                            @if ($pendaftaran->status === 'pending')
                                <span
                                    class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded-full text-sm font-medium">Menunggu</span>
                            @elseif($pendaftaran->status === 'approved')
                                <span
                                    class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-sm font-medium">Disetujui</span>
                            @elseif(in_array($pendaftaran->status, ['finished', 'selesai']))
                                <span
                                    class="bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-medium">Selesai</span>
                            @else
                                <span
                                    class="bg-red-100 text-red-800 px-4 py-2 rounded-full text-sm font-medium">Ditolak</span>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

            <!-- Section Perizinan -->
            <div class="border-t pt-8">
                <h3 class="font-semibold text-lg mb-4">Perizinan</h3>

                @php $perizinan = $pendaftaran->perizinan()->first(); @endphp

                @if ($perizinan)
                    <div class="bg-gray-50 border rounded-lg p-6 space-y-5">

                        <div>
                            <p class="text-sm text-gray-500">Status Perizinan</p>
                            <p class="font-semibold text-lg">{{ ucfirst($perizinan->status) }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Tanggal Dikirim</p>
                            <p class="font-medium">
                                {{ $perizinan->tanggal_dikirim
                                    ? \Carbon\Carbon::parse($perizinan->tanggal_dikirim)->translatedFormat('d F Y H:i')
                                    : '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Catatan</p>
                            <p class="whitespace-pre-line text-gray-700">{{ $perizinan->catatan ?? '-' }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">File Surat Perizinan</p>
                            @if ($perizinan->file)
                                <a href="{{ asset('storage/' . $perizinan->file) }}" target="_blank"
                                    class="text-blue-600 hover:underline font-medium">
                                    Lihat / Unduh surat ({{ basename($perizinan->file) }})
                                </a>
                            @else
                                <p class="text-gray-500">Belum ada file.</p>
                            @endif
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Dikirim oleh</p>
                            <p class="font-medium">{{ $perizinan->admin?->name ?? '-' }}</p>
                        </div>

                    </div>
                @else
                    <p class="text-gray-500 italic">Belum ada perizinan untuk pendaftaran ini.</p>
                @endif
            </div>

            <a href="{{ route('list-pendaftaran-program') }}"
                class="inline-flex items-center justify-center gap-2 w-full px-6 mt-5 py-3.5 bg-[#0C356A] text-white font-semibold rounded-xl hover:bg-[#0a2b55] transform hover:scale-105 transition-all duration-300 shadow-md hover:shadow-xl">
                ← Kembali ke daftar pendaftaran
            </a>
        </div>
    </div>
</div>
