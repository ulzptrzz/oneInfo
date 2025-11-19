@props(['program'])

<div>
    <x-navbar />

    <div class="max-w-6xl mx-auto p-6">

        <h2 class="text-4xl text-center  md:text-5xl font-bold text-[#0C356A] mb-4">
            Katalog <span class="text-[#ffc436]">Program</span>
        </h2>
        <p class="text-lg text-center text-gray-600 mb-10"> Lihat berbagai program menarik yang didukung oleh SMKN 1 Kota
            Bekasi </p>

        <div class="bg-white rounded-xl shadow-md p-5 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="text" wire:model.debounce.500ms="search"
                    placeholder="Cari nama siswa / program..."
                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#0C356A] focus:outline-none">

                <select wire:model.live="statusFilter"
                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#0C356A] focus:outline-none">
                    <option value="all">Semua Status</option>
                    <option value="published">Published</option>
                    <option value="archived">Archived</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            @forelse ($program as $index => $item)
            <div class="bg-white relative shadow rounded-xl overflow-hidden hover:shadow-lg transition">

                <img src="{{ asset('storage/' . $item->poster) }}" class="w-full h-48 object-cover">

                <div class="p-6 space-y-4">

                    <div class="flex justify-between">
                        <h3 class="text-2xl font-bold text-[#0C356A] line-clamp-2 leading-tight">
                            {{ $item->name }}
                        </h3>
                        <span
                            class="inline-block px-4 py-1.5 text-xs font-semibold text-indigo-700 bg-indigo-100 rounded-full border border-indigo-200">
                            {{ $item->kategoriProgram->nama_kategori ?? 'Umum' }}
                        </span>
                    </div>


                    <p class="text-gray-600 text-sm leading-relaxed line-clamp-3">
                        {{ Str::limit(strip_tags($item->deskripsi), 120) }}
                    </p>

                    <div class="pt-3">
                        <a href="{{ route('guest-detail-program', $item->id) }}"
                            class="inline-flex items-center gap-2 w-full justify-center px-6 py-3.5 bg-[#0C356A] text-white font-semibold rounded-xl hover:bg-[#0a2b55] transform hover:scale-105 transition-all duration-300 shadow-md hover:shadow-xl">
                            <span>Lihat Detail</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-1 md:col-span-2 lg:col-span-3">
                <div
                    class="bg-[#D6EBFF] rounded-xl flex flex-col items-center justify-center py-8 px-4 text-center">
                    <svg width="120px" height="120px" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg" class="mb-3">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M9.29289 1.29289C9.48043 1.10536 9.73478 1 10 1H18C19.6569 1 21 2.34315 21 4V7C21 7.55228 20.5523 8 20 8C19.4477 8 19 7.55228 19 7V4C19 3.44772 18.5523 3 18 3H11V8C11 8.55228 10.5523 9 10 9H5V20C5 20.5523 5.44772 21 6 21H11C11.5523 21 12 21.4477 12 22C12 22.5523 11.5523 23 11 23H6C4.34315 23 3 21.6569 3 20V8C3 7.73478 3.10536 7.48043 3.29289 7.29289L9.29289 1.29289ZM6.41421 7H9V4.41421L6.41421 7ZM18.25 20.75C18.25 21.4404 17.6904 22 17 22C16.3096 22 15.75 21.4404 15.75 20.75C15.75 20.0596 16.3096 19.5 17 19.5C17.6904 19.5 18.25 20.0596 18.25 20.75ZM15.1353 12.9643C15.3999 12.4596 16.0831 12 17 12C18.283 12 19 12.8345 19 13.5C19 14.1655 18.283 15 17 15C16.4477 15 16 15.4477 16 16V17C16 17.5523 16.4477 18 17 18C17.5523 18 18 17.5523 18 17V16.8866C19.6316 16.5135 21 15.2471 21 13.5C21 11.404 19.0307 10 17 10C15.4566 10 14.0252 10.7745 13.364 12.0357C13.1075 12.5248 13.2962 13.1292 13.7853 13.3857C14.2744 13.6421 14.8788 13.4535 15.1353 12.9643Z"
                            fill="#0C356A" />
                    </svg>
                    <p class="text-[#0C356A] font-semibold text-[15px]">Belum ada program</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
    <x-whatsapp />
    <x-footer />
</div>