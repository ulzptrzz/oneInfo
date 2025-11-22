<div class="p-6">
    <h1 class="text-2xl font-semibold mb-4">Daftar Perizinan</h1>

    <div class="mb-4">
        <input wire:model.debounce.500ms="search" placeholder="Cari nama siswa..." class="w-full border rounded px-3 py-2" />
    </div>

    <table class="w-full table-auto bg-white rounded shadow">
        <thead class="bg-[#0C356A] text-white">
            <tr>
                <th class="px-4 py-2">No</th>
                <th class="px-4 py-2">Siswa</th>
                <th class="px-4 py-2">Program</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($perizinans as $i => $p)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $perizinans->firstItem() + $i }}</td>
                    <td class="px-4 py-2">{{ $p->pendaftaran->siswa->user->name }}</td>
                    <td class="px-4 py-2">{{ $p->pendaftaran->program->name }}</td>
                    <td class="px-4 py-2">{{ ucfirst($p->status) }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('admin.perizinan.view', $p->id) }}" class="text-blue-600 underline">Detail</a>
                        @if($p->surat_path)
                            <a href="{{ asset('storage/'.$p->file) }}" target="_blank" class="ml-2 text-gray-700">Unduh Surat</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">{{ $perizinan->links() }}</div>
</div>
