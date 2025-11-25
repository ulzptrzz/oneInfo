<div class="flex min-h-screen">

    <aside class="fixed overflow-y-auto">
        <x-sidebar-superadmin />
    </aside>

    {{-- KONTEN UTAMA --}}
    <div class="flex-1 ml-64 mr-20 min-h-screen">
        <div class="w-full mx-8 my-7 bg-white rounded-2xl shadow-md overflow-hidden">

            <div class="bg-[#0C356A] text-white p-8">
                <h1 class="text-3xl font-bold flex items-center gap-3">
                    Tambah Admin
                </h1>
            </div>

            <form wire:submit.prevent="store" class="space-y-5 bg-white p-6 rounded-lg shadow" novalidate>
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
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Foto
                    </label>

                    <input type="file" wire:model="foto" accept="image/*" id="fotoInput" class="hidden" />

                    <button type="button" onclick="document.getElementById('fotoInput').click()"
                        class="bg-[#FFC436] text-[#0C356A] px-6 py-3 rounded-lg font-semibold hover:bg-yellow-400 transition">
                        Choose File
                    </button>

                    @error('foto')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                @if ($foto && !is_array($foto))
                    <div
                        class="flex-1 flex items-center justify-between bg-green-50 border-2 border-green-200 rounded-lg px-4 py-2 mt-5">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                                <i class='bx bx-image text-white text-xl'></i>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-800">{{ $foto->getClientOriginalName() }}</p>
                                <p class="text-xs text-gray-500">{{ number_format($foto->getSize() / 1024, 2) }} KB</p>
                            </div>
                        </div>
                        <button type="button" wire:click="$set('foto', null)" class="text-red-500 hover:text-red-700">
                            <i class='bx bx-trash text-xl'></i>
                        </button>
                    </div>
                @endif


                <div class="flex gap-4">
                    <a href="{{ route('superadmin.admin.akun-admin') }}"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded ">Batal</a>
                    <button type="submit" class="bg-[#0C356A] text-white px-4 py-2 rounded">Tambah Admin</button>
                </div>
            </form>
        </div>
    </div>
</div>
