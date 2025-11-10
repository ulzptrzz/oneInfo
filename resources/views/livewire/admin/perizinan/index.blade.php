    <div class="flex min-h-screen">
        <x-sidebar />

        <div class="p-6">
            <h1 class="text-2xl font-bold mb-4 text-gray-800">Manajemen Program</h1>

            @if (session()->has('message'))
            <div class="bg-green-100 text-green-700 p-2 rounded mb-3">{{ session('message') }}</div>
            @endif

            <div class="flex justify-between mb-4">
                <input type="text" wire:model.live="search" placeholder="Cari program..." class="border rounded px-3 py-2 w-1/3">
                <a href="{{ route('create-perizinan') }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    + Tambah Perizinan
                </a>
            </div>

            <table class="w-full border-collapse bg-white shadow rounded-lg">
                <thead class="bg-gray-100">
                    <tr class="text-left">
                        <th class="px-4 py-2 border">#</th>
                        <th class="px-4 py-2 border">Nama Program</th>
                        <th class="px-4 py-2 border">Kategori</th>
                        <th class="px-4 py-2 border">Deskripsi</th>
                        <th class="px-4 py-2 border">Gambar</th>
                        <th class="px-4 py-2 border text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>

            <div class="mt-3">

            </div>
        </div>
    </div>