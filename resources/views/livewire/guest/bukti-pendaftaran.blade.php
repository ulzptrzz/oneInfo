<div>
    <h2>Tampilkan bukti pendaftaran</h2>
    <div>{{ $bukti->name }}</div>
    <div>{{ $bukti->deskripsi }}</div>
    <div>
        {{ $user->name }}
        {{ $user->email }}
        {{ $user->siswa->kelas->tingkat }}
        {{ $user->siswa->kelas->jurusan->nama_jurusan }}
        {{ $user->siswa->kelas->nama_kelas }}
    </div>
    <form class="space-y-5 bg-white p-6 rounded-lg shadow">
        <div>
            <label class="block font-semibold text-gray-700 mb-1">Bukti Pendaftaran</label>
            <input type="file" wire:model="foto" accept="image/*" class="border p-2 w-full rounded">
            @error('bukti_pendaftaran')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block font-semibold text-gray-700 mb-1">mata_lomba</label>
            <select id="" wire:model="mata_lomba_id" class="border p-2 w-full rounded">
                <option value="">-- Pilih mata_lomba --</option>
               
            </select>
            @error('mata_lomba')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>

        </div>
    </form>
</div>
