<div class="max-w-2xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-6">Upload Bukti Pendaftaran</h2>

    <!-- Info Program & Siswa -->
    <div class="bg-gray-50 p-5 rounded-lg mb-6">
        <h3 class="font-semibold text-lg">{{ $bukti->name }}</h3>
        <p class="text-gray-600">{{ $bukti->deskripsi }}</p>
        <div class="mt-3 text-sm">
            <p><strong>Siswa:</strong> {{ $user->name }}</p>
            <p><strong>Kelas:</strong> {{ $user->siswa->kelas->tingkat }}
                {{ $user->siswa->kelas->jurusan->nama_jurusan }}
                {{ $user->siswa->kelas->nama_kelas }}</p>
        </div>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-5">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="simpan" class="bg-white shadow-lg rounded-lg p-6 space-y-6">

        <!-- Upload Bukti -->
        <div>
            <label class="block font-medium mb-2">Bukti Pendaftaran (Foto/Scan)</label>
            <input type="file" wire:model="foto" accept="image/*,application/pdf"
                class="w-full border rounded-lg p-3">
            @error('foto')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Tanggal Daftar -->
        <div>
            <label class="block font-medium mb-2">Tanggal Pendaftaran</label>
            <input type="date" wire:model="tanggal_pendaftaran" class="w-full border rounded-lg p-3">
            @error('tanggal_pendaftaran')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Pelaksanaan -->
        <div>
            <label class="block font-medium mb-2">Pelaksanaan</label>
            <select wire:model="pelaksanaan" class="w-full border rounded-lg p-3">
                <option value="">-- Pilih Pelaksanaan --</option>
                <option value="online">Online</option>
                <option value="offline">Offline</option>
            </select>
            @error('pelaksanaan')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="text-right">
            <button type="submit"
                class="bg-indigo-600 text-white px-8 py-3 rounded-lg hover:bg-indigo-700 font-medium">
                Kirim Pendaftaran
            </button>
        </div>
    </form>
</div>