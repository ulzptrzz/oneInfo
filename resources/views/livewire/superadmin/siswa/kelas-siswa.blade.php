<div>
    <div class="flex min-h-screen">
        <x-sidebar-superadmin />

        <div class="w-full mx-8 my-7 bg-white rounded-2xl shadow-md overflow-hidden">
            <div class="bg-[#0C356A] text-white p-7 flex justify-between items-center">
                <h2 class="text-2xl font-bold items-center">Kelola Akun Siswa</h2>
                <div class="flex gap-3 justify-end">
                    <a href="{{ route('superadmin.siswa.create-kelas-siswa') }}"
                        class="bg-[#ffc436] text-[#0C356A] font-semibold px-4 py-2 rounded-lg hover:bg-yellow-400 transition">
                        + Tambah Kelas
                    </a>
                    <a href="{{ route('superadmin.siswa.kelola-jurusan') }}"
                        class="bg-[#ffc436] text-[#0C356A] font-semibold px-4 py-2 rounded-lg hover:bg-yellow-400 transition">
                        + Tambah Jurusan
                    </a>
                    <a href="{{ route('superadmin.siswa.akun-siswa') }}"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition">
                        <i class="bx bx-arrow-back"></i> Kembali
                    </a>
                </div>
            </div>

            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama Kelas</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Jurusan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tingkat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tahun Ajaran</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sesions as $sesion)
                        <tr class="table-row">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-medium text-gray-900">{{ $loop->iteration }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                <span class="text-sm font-medium text-gray-900">{{ $sesion->nama_kelas }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                <span
                                    class="text-sm font-medium text-gray-900">{{ $sesion->jurusan?->nama_jurusan ?? 'tidak ada jurusan' }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                <span class="text-sm font-medium text-gray-900">{{ $sesion->tingkat }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                <span class="text-sm font-medium text-gray-900">{{ $sesion->tahun_ajaran }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <a href="{{ route('superadmin.siswa.edit-kelas-siswa', $sesion->id) }}"
                                    class="bg-blue-500 text-white px-3 py-1.5 rounded-lg hover:bg-blue-600 text-sm font-medium inline-flex items-center gap-1 transition">
                                    <i class='bx bx-edit'></i>
                                    Edit
                                </a>
                                <button type="button" wire:click="confirmDelete({{ $sesion->id }})"
                                    wire:confirm="Apakah kamu yakin ingin menghapus program '{{ $sesion->name }}'?"
                                    class="bg-red-500 text-white px-3 py-1.5 rounded-lg hover:bg-red-600 text-sm font-medium inline-flex items-center gap-1 transition">
                                    <i class='bx bx-trash'></i>
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if ($showDeleteModal)
                <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                    <div class="bg-white rounded-lg shadow-xl p-6 max-w-sm w-full">
                        <h3 class="text-lg font-semibold text-[#0C356A]">Hapus Kelas?</h3>
                        <p class="text-sm text-gray-600 mb-6">
                            Apakah Anda yakin ingin menghapus kelas ini?
                        </p>

                        <div class="flex justify-end gap-3">
                            <button wire:click="cancelDelete"
                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                                Batal
                            </button>
                            <button wire:click="hapus" wire:loading.attr="disabled"
                                class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 disabled:opacity-50">
                                <span wire:loading.remove>Hapus</span>
                                <span wire:loading>Hapus...</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <script>
            document.addEventListener('click', function(e) {
                const modal = document.querySelector('.fixed.inset-0');
                if (modal && e.target === modal) {
                    @this.call('cancelDelete');
                }
            });
        </script>
    </div>
</div>
