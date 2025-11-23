<<<<<<< Updated upstream
<div class="flex min-h-screen">

    <aside class="fixed overflow-y-auto">
        <x-sidebar />
    </aside>

    {{-- KONTEN UTAMA --}}
    <div class="flex-1 ml-64 mr-20 min-h-screen">
        <div class="w-full mx-8 my-7 overflow-hidden">

            <div class="bg-white rounded-2xl p-8 text-[#0C356A] mb-5">

                <h2 class="text-xl font-semibold mb-4">Kirim Perizinan — {{ $pendaftaran->siswa->user->name }}</h2>

                <div class="mb-4">
                    <p>Program: <strong>{{ $pendaftaran->program->name }}</strong></p>
                    <p>Tanggal Daftar:
                        {{ \Carbon\Carbon::parse($pendaftaran->tanggal_daftar)->translatedFormat('d F Y') }}</p>
                </div>

                @if (session('success'))
                    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
                @endif

                @if ($showForm)
                    <form wire:submit.prevent="send" class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium">Upload Surat (PDF)</label>
                            <input type="file" wire:model="surat_file" accept="application/pdf" />
                            @error('surat_file')
                                <div class="text-red-600 text-sm">{{ $message }}</div>
                            @enderror

                            @if ($surat_file)
                                <p class="text-sm text-gray-600 mt-2">File siap diupload:
                                    {{ $surat_file->getClientOriginalName() }}</p>
                            @endif
                        </div>

                        <div>
                            <label class="block text-sm font-medium">Catatan (opsional)</label>
                            <textarea wire:model="catatan" class="w-full border rounded p-2" rows="4"></textarea>
                            @error('catatan')
                                <div class="text-red-600 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="flex gap-3">
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Kirim
                                Perizinan</button>
                            <a href="{{ route('list-pendaftaran-program') }}" class="px-4 py-2 border rounded">Batal</a>
                        </div>
                    </form>
                @else
                    <div class="bg-yellow-50 p-4 rounded">
                        <p class="text-sm">Perizinan untuk pendaftaran ini sudah dikirim sebelumnya.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
=======
<div class="flex min-h-screen bg-gray-100">
    <x-sidebar />

    <div class="w-full mx-8 my-9">

        <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">

            {{-- Header --}}
            <div class="mb-6">
                <h2 class="text-3xl font-extrabold text-[#0C356A]">
                    Kirim Perizinan
                </h2>
                <p class="text-gray-600 text-sm mt-1">
                    Untuk siswa: <span class="font-semibold">{{ $pendaftaran->siswa->user->name }}</span>
                </p>
            </div>

            {{-- Info Program --}}
            <div class="bg-gradient-to-r from-blue-50 to-blue-100 border border-blue-200 rounded-xl p-5 mb-6">
                <h3 class="font-semibold text-[#0C356A] mb-3">Informasi Program</h3>
                <p class="text-[15px] text-gray-700 mb-1">
                    <strong>Program:</strong> {{ $pendaftaran->program->name }}
                </p>
                <p class="text-[15px] text-gray-700">
                    <strong>Tanggal Daftar:</strong>
                    {{ \Carbon\Carbon::parse($pendaftaran->tanggal_daftar)->translatedFormat('d F Y') }}
                </p>
            </div>

            {{-- Success Notification --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg mb-6 text-sm shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Form --}}
            @if($showForm)
                <form wire:submit.prevent="send" class="space-y-6">

                    {{-- Upload --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-800 mb-1">
                            Upload Surat Perizinan (PDF)
                        </label>

                        <div class="relative">
                            <input
                                type="file"
                                wire:model="surat_file"
                                accept="application/pdf"
                                class="block w-full text-sm border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:ring-2 focus:ring-[#0C356A] focus:border-[#0C356A] p-2.5">
                        </div>

                        @error('surat_file')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror

                        @if ($surat_file)
                            <p class="text-sm text-gray-500 mt-2 italic">
                                File siap diupload: {{ $surat_file->getClientOriginalName() }}
                            </p>
                        @endif
                    </div>

                    {{-- Catatan --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-800 mb-1">
                            Catatan (opsional)
                        </label>
                        <textarea
                            wire:model="catatan"
                            rows="4"
                            class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:ring-2 focus:ring-[#0C356A] focus:border-[#0C356A]"></textarea>

                        @error('catatan')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Buttons --}}
                    <div class="flex items-center gap-3 pt-4">
                        <button
                            type="submit"
                            class="bg-[#FFC436] hover:bg-[#e8ac2f] transition text-white px-6 py-2.5 rounded-lg shadow-md font-semibold">
                            Kirim Perizinan
                        </button>

                        <a href="{{ route('list-pendaftaran-program') }}"
                           class="px-6 py-2.5 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100 transition font-medium">
                            Batal
                        </a>
                    </div>
                </form>

            @else
                {{-- Sudah Pernah Dikirim --}}
                <div class="bg-yellow-50 border border-yellow-300 text-yellow-800 px-5 py-4 rounded-lg text-sm shadow-sm">
                    Perizinan untuk pendaftaran ini sudah pernah dikirim sebelumnya.
                </div>
            @endif
        </div>
    </div>
</div>
>>>>>>> Stashed changes
