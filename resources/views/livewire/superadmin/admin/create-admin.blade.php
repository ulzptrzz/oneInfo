<div>
    <div class="flex min-h-screen">
        <x-sidebar-superadmin />

        <div class="flex-1 p-8 bg-gray-50">
            <h1 class="mb-5 text-2xl font-bold text-[#0C356A]">Tambah Admin</h1>

            <form wire:submit.prevent="store" class="space-y-5 bg-white p-6 rounded-lg shadow">
                <!-- Nama -->
                <div>
                    <label>Nama Admin</label>
                    <input type="text" wire:model="name" class="border p-2 w-full">
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label>Email</label>
                    <input type="email" wire:model="email" class="border p-2 w-full">
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label>Password</label>
                    <input type="password" wire:model="password" class="border p-2 w-full">
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Foto -->
                <div>
                    <label class="block font-semibold text-gray-700 mb-1">Foto</label>
                    <input type="file" wire:model="foto" accept="image/*" class="border p-2 w-full rounded">

                    @error('foto')
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
