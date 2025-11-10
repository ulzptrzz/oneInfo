<div>
    <div class="flex min-h-screen">
        <aside class="w-64 bg-blue-700 text-white p-6 space-y-6">
            <h1 class="text-xl font-bold">Admin OneInfo</h1>
            <nav class="space-y-2">
                <a href="{{ route('superadmin.siswa.akun-siswa') }}"
                    class="block hover:bg-blue-600 rounded px-3 py-2">Akun
                    Siswa</a>
                <a href="{{ route('superadmin.admin.akun-admin') }}"
                    class="block hover:bg-blue-600 rounded px-3 py-2">Akun
                    Admin</a>
            </nav>
        </aside>

        <div>
            <h1 class="mb-5 text-2xl font-bold text-[#0C356A]">Tambah Admin</h1>

            <form wire:submit.prevent="store" class="space-y-3">
                <div>
                    <label>Nama Admin</label>
                    <input type="text" wire:model="name" class="border p-2 w-full">
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label>Email</label>
                    <input type="email" wire:model="email" class="border p-2 w-full">
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label>Password</label>
                    <input type="password" wire:model="password" class="border p-2 w-full">
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex gap-4">
                    <a href="{{ route('superadmin.admin.akun-admin') }}"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded ">Batal</a>
                    <button type="submit" class="bg-[#0C356A] text-white px-4 py-2 rounded">Tambah Admin</button>
                </div>
            </form>
        </div>
    </div>
</div>
