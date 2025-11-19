<div>
    <div class="flex min-h-screen">
        <x-sidebar-superadmin />

        <div class="w-full mx-8 my-7 bg-white rounded-2xl shadow-md overflow-hidden">
            <div class="bg-[#0C356A] text-white p-7 flex justify-between items-center">
                <h2 class="text-2xl font-bold items-center">Kelola Akun Siswa</h2>
                <div class="flex gap-3 justify-end">
                    <a href="{{ route('superadmin.siswa.kelas-siswa') }}"
                        class="bg-[#ffc436] text-[#0C356A] font-semibold px-4 py-2 rounded-lg hover:bg-yellow-400 transition">
                        + Tambah Admin
                    </a>
                    <a href="{{ route('superadmin.siswa.create-siswa') }}"
                        class="bg-[#ffc436] text-[#0C356A] font-semibold px-4 py-2 rounded-lg hover:bg-yellow-400 transition">
                        + Tambah Siswa
                    </a>
                    <button wire:click="openExcelModal"
                        class="bg-[#ffc436] text-[#0C356A] font-semibold px-4 py-2 rounded-lg hover:bg-yellow-400 transition">
                        + Import Siswa
                    </button>
                </div>
            </div>

            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            No</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama Siswa</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Email</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nis</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nisn</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Foto</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sesions as $sesion)
                        <tr class="table-row">
                            <td class="px-4 py-4 whitespace-nowrap">
                                <span class="text-sm font-medium text-gray-900">{{ $loop->iteration }}</span>
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap">
                                <span class="text-sm font-medium text-gray-900">{{ $sesion->name }}</span>
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap">
                                <span class="text-sm font-medium text-gray-900">{{ $sesion->user->email }}</span>
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap">
                                <span class="text-sm font-medium text-gray-900">{{ $sesion->nis }}</span>
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap">
                                <span class="text-sm font-medium text-gray-900">{{ $sesion->nisn }}</span>
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap">
                                <img src="{{ asset('storage/' . $sesion->foto) }}" alt="Foto Siswa"
                                    class="w-32 rounded">
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap text-sm">
                                <a href="{{ route('superadmin.siswa.edit-siswa', $sesion->id) }}"
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
            @if ($showExcelModal)
                <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
                    wire:ignore.self>
                    <div class="bg-white rounded-lg shadow-xl p-6 max-w-md w-full" @click.away="closeExcelModal">
                        <h3 class="text-lg font-semibold text-[#0C356A] mb-4">Import Siswa dari Excel</h3>

                        @if ($errors->has('fileExcel'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4 text-sm">
                                {!! $errors->first('fileExcel') !!}
                            </div>
                        @endif

                        <form wire:submit.prevent="importExcel">
                            <div class="mb-4">
                                <input type="file" wire:model="fileExcel"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                                    accept=".xlsx,.xls">
                                @error('fileExcel')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex justify-end gap-3">
                                <button type="button" wire:click="closeExcelModal"
                                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                                    Batal
                                </button>
                                <button type="submit"
                                    class="px-4 py-2 bg-[#0C356A] text-white rounded hover:bg-[#082d5b] disabled:opacity-50"
                                    wire:loading.attr="disabled">
                                    <span wire:loading.remove>Import</span>
                                    <span wire:loading>Memproses...</span>
                                </button>
                            </div>
                        </form>

                        <div class="mt-4 text-xs text-gray-600 border-t pt-3">
                            <p><strong>Format Excel (baris pertama = header):</strong></p>
                            <table class="text-xs mt-2 w-full">
                                <tr>
                                    <th class="text-left">Kolom</th>
                                    <th class="text-left pl-2">Contoh</th>
                                </tr>
                                <tr>
                                    <td>name</td>
                                    <td>Budi Santoso</td>
                                </tr>
                                <tr>
                                    <td>nis</td>
                                    <td>12345</td>
                                </tr>
                                <tr>
                                    <td>nisn</td>
                                    <td>0001234567</td>
                                </tr>
                                <tr>
                                    <td>foto</td>
                                    <td>siswa/budi.jpg</td>
                                </tr>
                                <tr>
                                    <td>user_id</td>
                                    <td>5 (opsional)</td>
                                </tr>
                                <tr>
                                    <td>kelas_id</td>
                                    <td>1</td>
                                </tr>
                            </table>
                            <p class="mt-2">Download template:
                                <a href="{{ asset('template_siswa.xlsx') }}" class="text-blue-600 underline">
                                    template_siswa.xlsx
                                </a>
                            </p>
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
