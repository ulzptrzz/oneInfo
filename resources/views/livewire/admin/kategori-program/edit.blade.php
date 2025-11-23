<div class="flex min-h-screen">

    <aside class="fixed overflow-y-auto">
        <x-sidebar active="program" />
    </aside>

    {{-- KONTEN UTAMA --}}
    <div class="flex-1 ml-64 mr-20 min-h-screen">
        <div class="w-full mx-8 my-7 bg-white rounded-2xl shadow-md overflow-hidden">
            {{-- Header --}}
            <div class="bg-[#0C356A] text-white p-6">
                <h1 class="text-2xl font-bold flex items-center gap-2">
                    Edit Kategori
                </h1>
            </div>

            {{-- Form --}}
            <div class="p-8">
                <form wire:submit.prevent="update" class="space-y-6">

                    {{-- Nama Kategori --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Kategori
                        </label>
                        <input type="text" wire:model="nama_kategori" placeholder="Contoh: Lomba"
                            class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-[#FFC436] focus:outline-none transition" />
                        @error('nama_kategori')
                            <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                                <i class='bx bx-error-circle'></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Deskripsi Kategori --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Deskripsi Kategori
                        </label>
                        <textarea wire:model="deskripsi" rows="4" placeholder="Jelaskan kategori ini..."
                            class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-[#FFC436] focus:outline-none transition resize-none"></textarea>
                        @error('deskripsi')
                            <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                                <i class='bx bx-error-circle'></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.kategori-program') }}"
                            class="px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition text-center">
                            Kembali
                        </a>
                        <button type="submit"
                            class="px-6 py-3 bg-[#FFC436] text-[#0C356A] font-bold rounded-lg hover:bg-yellow-400 transition inline-flex items-center justify-center gap-2">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>