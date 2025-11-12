<div>
    <div class="flex min-h-screen">
        <x-sidebar-superadmin />

        <div>
            <div class="flex">
                <div class="text-[#0C356A]">
                    <h2 class="text-xl font-bold ">Kelola Akun Siswa</h2>
                    <p>Kelola akun siswa dengan baik</p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('superadmin.siswa.kelas-siswa') }}"
                        class="flex items-center gap-1 bg-[#0C356A] text-white px-3 py-2 rounded-md hover:bg-[#082d5b] transition">
                        <i class='bx bx-plus'></i> Kelas
                    </a>
                    <a href="{{ route('superadmin.siswa.create-siswa') }}"
                        class="flex items-center gap-1 bg-[#0C356A] text-white px-3 py-2 rounded-md hover:bg-[#082d5b] transition">
                        <i class='bx bx-plus'></i> Siswa
                    </a>
                </div>
            </div>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama Siswa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nis</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nisn</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Foto</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sesions as $sesion)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $sesion->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $sesion->nis }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $sesion->nisn }}
                            </td>
                            <td class="border p-2 text-center">
                                <img src="{{ asset('storage/' . $sesion->siswa) }}" alt="Foto Siswa" class="w-32 rounded">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <a href="{{ route('superadmin.siswa.edit-siswa', $sesion->id) }}"
                                    class="text-[#0C356A] hover:text-[#065fbd] font-medium">
                                    Edit
                                </a>
                                <button type="button" wire:click="confirmDelete({{ $sesion->id }})"
                                    class="text-red-600 hover:text-red-900 font-medium">
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
