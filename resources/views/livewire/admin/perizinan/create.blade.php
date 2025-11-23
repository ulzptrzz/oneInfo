<div class="p-6 bg-white rounded-xl shadow">
    <h2 class="text-xl font-semibold mb-4">Kirim Perizinan — {{ $pendaftaran->siswa->user->name }}</h2>

    <div class="mb-4">
        <p>Program: <strong>{{ $pendaftaran->program->name }}</strong></p>
        <p>Tanggal Daftar: {{ \Carbon\Carbon::parse($pendaftaran->tanggal_daftar)->translatedFormat('d F Y') }}</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    @if($showForm)
        <form wire:submit.prevent="send" class="space-y-4">
            <div>
                <label class="block text-sm font-medium">Upload Surat (PDF)</label>
                <input type="file" wire:model="surat_file" accept="application/pdf" />
                @error('surat_file') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror

                @if ($surat_file)
                    <p class="text-sm text-gray-600 mt-2">File siap diupload: {{ $surat_file->getClientOriginalName() }}</p>
                @endif
            </div>

            <div>
                <label class="block text-sm font-medium">Catatan (opsional)</label>
                <textarea wire:model="catatan" class="w-full border rounded p-2" rows="4"></textarea>
                @error('catatan') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Kirim Perizinan</button>
                <a href="{{ route('list-pendaftaran-program') }}" class="px-4 py-2 border rounded">Batal</a>
            </div>
        </form>
    @else
        <div class="bg-yellow-50 p-4 rounded">
            <p class="text-sm">Perizinan untuk pendaftaran ini sudah dikirim sebelumnya.</p>
        </div>
    @endif
</div>
