<div>
    <div class="flex min-h-screen">
        <x-sidebar-superadmin />
        <div class="w-full mx-8 my-7 bg-white rounded-2xl shadow-md overflow-hidden">
            <div class="bg-[#0C356A] text-white p-7 flex justify-between items-center">
                <h2 class="text-2xl font-bold flex items-center gap-2">
                    List Akun Admin
                </h2>

                <a href="{{ route('superadmin.admin.create-admin') }}"
                    class="bg-[#FFC436] text-[#0C356A] font-semibold px-4 py-2 rounded-lg hover:bg-yellow-400 transition">
                    + Tambah Admin
                </a>
            </div>

            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100 border-b-2 border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            No
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Nama
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Email
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Phone
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($kelola_admins as $admin)
                        <tr class="table-row">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-medium text-gray-900">{{ $loop->iteration }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-medium text-gray-900">{{ $admin->name }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-medium text-gray-900">{{ $admin->email }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="text-sm font-medium text-gray-900">{{ $admin->phone ?? '08123456789' }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <a href="{{ route('superadmin.admin.edit-admin', $admin->id) }}"
                                    class="bg-blue-500 text-white px-3 py-1.5 rounded-lg hover:bg-blue-600 text-sm font-medium inline-flex items-center gap-1 transition">
                                    <i class='bx bx-edit'></i>
                                    Edit
                                </a>
                                <button type="button" wire:click="confirmDelete({{ $admin->id }})"
                                    wire:confirm="Apakah kamu yakin ingin menghapus program '{{ $admin->name }}'?"
                                    class="bg-red-500 text-white px-3 py-1.5 rounded-lg hover:bg-red-600 text-sm font-medium inline-flex items-center gap-1 transition">
                                    <i class='bx bx-trash'></i>
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                Belum ada akun admin.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            @if ($showDeleteModal)
                <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                    <div class="bg-white rounded-lg shadow-xl p-6 max-w-sm w-full">
                        <h3 class="text-lg font-semibold text-[#0C356A]">Hapus Admin?</h3>
                        <p class="text-sm text-gray-600 mb-6">
                            Apakah Anda yakin ingin menghapus admin ini?
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
