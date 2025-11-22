<div class="flex min-h-screen">
    <x-sidebar />

    <div class="w-full mx-8 my-7 bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="p-6">
            <a href="{{ route('list-pendaftaran-program') }}" class="text-blue-600 hover:underline mb-4 inline-block">← Kembali ke daftar pendaftaran</a>

            <div class="bg-white rounded-xl shadow p-6">
                <h2 class="text-2xl font-bold mb-4">Detail Pendaftaran</h2>

                {{-- Siswa & Program --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="space-y-2">
                        <p class="text-sm text-gray-500">Nama Siswa</p>
                        <p class="font-medium text-lg">{{ $pendaftaran->siswa->user->name }}</p>
                        <p class="text-sm text-gray-500">NIS</p>
                        <p>{{ $pendaftaran->siswa->nis }}</p>
                        <p class="text-sm text-gray-500 mt-2">Tanggal Daftar</p>
                        <p>{{ \Carbon\Carbon::parse($pendaftaran->tanggal_daftar)->translatedFormat('d F Y') }}</p>
                    </div>

                    <div class="space-y-2">
                        <p class="text-sm text-gray-500">Program</p>
                        <p class="font-medium text-lg">{{ $pendaftaran->program->name }}</p>
                        <p class="text-sm text-gray-500">Penyelenggara</p>
                        <p>{{ is_string($pendaftaran->program->penyelenggara) ? $pendaftaran->program->penyelenggara : json_encode($pendaftaran->program->penyelenggara) }}</p>
                        <p class="text-sm text-gray-500 mt-2">Pelaksanaan</p>
                        <p>{{ ucfirst($pendaftaran->program->pelaksanaan) }}</p>
                    </div>
                </div>

                {{-- Bukti pendaftaran (uploaded by siswa) --}}
                <div class="mb-6">
                    <h3 class="font-semibold text-lg mb-2">Bukti Pendaftaran</h3>
                    @if($pendaftaran->bukti_pendaftaran)
                        <div class="flex items-start gap-4">
                            <div class="w-40">
                                @php
                                    $bukti = $pendaftaran->bukti_pendaftaran;
                                @endphp

                                @if(Str::endsWith($bukti, ['.jpg','.jpeg','.png','gif']))
                                    <img src="{{ asset('storage/' . $bukti) }}" alt="Bukti" class="w-full h-32 object-cover rounded">
                                @else
                                    <div class="p-3 border rounded text-sm">
                                        <i class="bx bx-file text-2xl"></i>
                                        <div class="mt-2">
                                            <a href="{{ asset('storage/' . $bukti) }}" target="_blank" class="text-blue-600 hover:underline">Lihat / Unduh bukti</a>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="flex-1">
                                <p class="text-sm text-gray-600">File: <span class="font-medium">{{ basename($bukti) }}</span></p>
                                @if($pendaftaran->syarat_pendaftaran)
                                    <p class="text-sm text-gray-600 mt-1">Syarat tambahan: <a href="{{ asset('storage/' . $pendaftaran->syarat_pendaftaran) }}" target="_blank" class="text-blue-600 hover:underline">Lihat</a></p>
                                @endif
                            </div>
                        </div>
                    @else
                        <p class="text-sm text-gray-500">Tidak ada bukti pendaftaran.</p>
                    @endif
                </div>

                {{-- Status & Aksi --}}
                <div class="mb-6">
                    <p class="text-sm text-gray-500">Status Pendaftaran</p>
                    <div class="my-2">
                        @if($pendaftaran->status === 'pending')
                            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full">Menunggu</span>
                        @elseif($pendaftaran->status === 'approved')
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full">Disetujui</span>
                        @elseif($pendaftaran->status === 'finished' || $pendaftaran->status === 'selesai')
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full">Selesai</span>
                        @else
                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full">Ditolak</span>
                        @endif
                    </div>

                    <div class="mt-4">
                        @if($pendaftaran->status === 'approved')
                            @if(strtolower($pendaftaran->program->pelaksanaan) === 'offline')
                                {{-- Jika belum ada perizinan → tombol kirim --}}
                                @if(! $pendaftaran->perizinan()->exists())
                                    <a href="{{ route('create-perizinan', $pendaftaran->id) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">Kirim Perizinan</a>
                                @else
                                    <a href="{{ route('detail-pendaftaran', $pendaftaran->id) }}" class="bg-gray-600 text-white px-4 py-2 rounded">Detail</a>
                                @endif
                            @else
                                {{-- online → langsung detail --}}
                                <a href="{{ route('detail-pendaftaran', $pendaftaran->id) }}" class="bg-gray-600 text-white px-4 py-2 rounded">Detail</a>
                            @endif
                        @else
                            <a href="{{ route('detail-pendaftaran', $pendaftaran->id) }}" class="bg-gray-600 text-white px-4 py-2 rounded">Detail</a>
                        @endif
                    </div>
                </div>

                {{-- Detail Perizinan (jika ada) --}}
                <div>
                    <h3 class="font-semibold text-lg mb-2">Perizinan</h3>
                    @php $perizinan = $pendaftaran->perizinan()->first(); @endphp

                    @if($perizinan)
                        <div class="bg-gray-50 border rounded p-4 space-y-3">
                            <div>
                                <p class="text-sm text-gray-500">Status Perizinan</p>
                                <p class="font-medium">
                                    {{ ucfirst($perizinan->status) }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">Tanggal Dikirim</p>
                                <p class="font-medium">{{ $perizinan->tanggal_dikirim ? \Carbon\Carbon::parse($perizinan->tanggal_dikirim)->translatedFormat('d F Y H:i') : '-' }}</p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">Catatan</p>
                                <p class="whitespace-pre-line">{{ $perizinan->catatan ?? '-' }}</p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">File Surat</p>
                                @if($perizinan->file)
                                    <a href="{{ asset('storage/' . $perizinan->file) }}" target="_blank" class="text-blue-600 hover:underline">Lihat / Unduh surat perizinan ({{ basename($perizinan->file) }})</a>
                                @else
                                    <p class="text-sm text-gray-500">Belum ada file.</p>
                                @endif
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">Dikirim oleh</p>
                                <p>{{ $perizinan->admin ? $perizinan->admin->name : '-' }}</p>
                            </div>
                        </div>
                    @else
                        <p class="text-sm text-gray-500">Belum ada perizinan untuk pendaftaran ini.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
