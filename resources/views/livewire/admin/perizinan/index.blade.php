    <div class="flex min-h-screen">
        <x-sidebar />

        <div class="w-full mx-10 mt-10 bg-white rounded-2xl shadow-md overflow-hidden">
            <div class="bg-[#0C356A] text-white p-7 flex justify-between items-center">
                @if (session()->has('message'))
                <div class="bg-green-100 text-green-700 p-2 rounded mb-3">
                    {{ session('message') }}
                </div>
                @endif
                <h2 class="text-2xl font-bold flex items-center gap-2">Daftar Perizinan</h2>
                <a href="{{ route('create-perizinan') }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    + Tambah Perizinan
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-gray-700 m-4">
                    <thead class="bg-gray-800 text-white rounded-2xl">
                        <tr class="text-left">
                            <th class="px-4 py-2 border">No</th>
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
            </div>

            <div class="mt-3">
            </div>
        </div>
    </div>