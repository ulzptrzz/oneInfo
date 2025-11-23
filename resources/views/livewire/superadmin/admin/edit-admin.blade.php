<div class="flex min-h-screen">

    <aside class="fixed overflow-y-auto">
        <x-sidebar-superadmin />
    </aside>

    {{-- KONTEN UTAMA --}}
    <div class="flex-1 ml-64 mr-20 min-h-screen">
        <div class="w-full mx-8 my-7 bg-white rounded-2xl shadow-md overflow-hidden">

            <div class="bg-[#0C356A] text-white p-8">
                <h1 class="text-3xl font-bold flex items-center gap-3">
                    Edit Admin
                </h1>
            </div>

            <form wire:submit.prevent="update" class="space-y-5 bg-white p-6 rounded-lg shadow">
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

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Foto</label>

                    {{-- Foto lama --}}
                    @if ($oldFoto && !$foto)
                        <div class="mb-4 bg-blue-50 border-2 border-blue-200 rounded-lg p-4">
                            <p class="text-sm font-medium text-gray-700 mb-3">Foto Saat Ini:</p>
                            <div class="flex items-center gap-4">
                                <img src="{{ asset('storage/' . $oldFoto) }}" class="w-32 h-40 object-cover rounded-lg">
                                <div class="text-sm text-gray-600">
                                    <p class="font-medium">Foto saat ini</p>
                                    <p class="text-xs text-gray-500">Upload baru untuk mengganti</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Upload foto baru --}}
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        {{ $oldFoto ? 'Ganti Foto' : 'Upload Poster' }}
                    </label>

                    <div class="flex items-center gap-4">
                        <input type="file" accept="image/*" wire:model="foto" id="fotoInput" class="hidden">

                        <button type="button" onclick="document.getElementById('fotoInput').click()"
                            class="bg-[#FFC436] text-[#0C356A] px-6 py-3 rounded-lg font-semibold">
                            Choose File
                        </button>

                        @if (!$foto)
                            <span class="text-gray-500 text-sm">No file chosen</span>
                        @endif

                        @if ($foto)
                            <div
                                class="flex-1 flex items-center justify-between bg-green-50 border-2 border-green-200 rounded-lg px-4 py-2">
                                <div class="flex items-center gap-3">
                                    <i class='bx bx-image text-green-600 text-xl'></i>
                                    <div>
                                        <p class="text-sm font-semibold">{{ $foto->getClientOriginalName() }}</p>
                                        <p class="text-xs">{{ number_format($foto->getSize() / 1024, 2) }} KB</p>
                                    </div>
                                </div>
                                <button type="button" wire:click="$set('foto', null)"
                                    class="text-red-500 hover:text-red-700">
                                    <i class='bx bx-trash text-xl'></i>
                                </button>
                            </div>
                        @endif
                    </div>

                    @error('foto')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-4">
                    <a href="{{ route('superadmin.admin.akun-admin') }}"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded ">Batal</a>
                    <button type="submit" class="bg-[#0C356A] text-white px-4 py-2 rounded">Edit Admin</button>
                </div>
            </form>
        </div>
    </div>
</div>
