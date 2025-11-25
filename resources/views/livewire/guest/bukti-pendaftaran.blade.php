<div class="max-w-2xl mx-auto mt-10">

    <a href="{{ route('guest-detail-program', $bukti->id) }}"
        class="inline-flex items-center mb-8 gap-2 px-6 mt-5 py-3.5 bg-[#0C356A] text-white font-semibold rounded-xl hover:bg-[#0a2b55] transform hover:scale-105 transition-all duration-300 shadow-md hover:shadow-xl">
        <i class='bx bx-arrow-back text-xl'></i>
        Kembali
    </a>

    <h2 class="text-2xl font-bold mb-6">Upload Bukti Pendaftaran</h2>

    <!-- Info Program & Siswa -->
    <div class="bg-white rounded-lg p-5 mb-6 shadow">
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

    <form wire:submit.prevent="simpan" class="bg-white shadow-lg rounded-lg p-6 space-y-6 mb-6">
        <!-- Upload Bukti -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">
                Bukti Pendaftaran <span class="text-red-500">*</span>
            </label>
            <div
                class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-indigo-400 transition-colors">
                <input type="file" wire:model="foto" accept="image/*\" class="hidden"
                    id="file-upload">
                <label for="file-upload" class="cursor-pointer">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                        viewBox="0 0 48 48">
                        <path
                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <p class="mt-3 text-sm text-gray-600">
                        <span class="text-indigo-600 font-medium hover:underline">Klik untuk upload</span> atau drag and
                        drop
                    </p>
                    <p class="text-xs text-gray-500 mt-1">PNG, JPG, (maks. 2MB)</p>
                </label>
            </div>
            @error('foto')
                <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
            @enderror

            @if ($foto && !is_array($foto))
                <div
                    class="flex-1 flex items-center justify-between bg-green-50 border-2 border-green-200 rounded-lg px-4 py-2 mt-5">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                            <i class='bx bx-image text-white text-xl'></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-800">{{ $foto->getClientOriginalName() }}</p>
                            <p class="text-xs text-gray-500">{{ number_format($foto->getSize() / 1024, 2) }} KB</p>
                        </div>
                    </div>
                    <button type="button" wire:click="$set('foto', null)" class="text-red-500 hover:text-red-700">
                        <i class='bx bx-trash text-xl'></i>
                    </button>
                </div>
            @endif
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
