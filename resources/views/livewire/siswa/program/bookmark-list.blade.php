<div class="flex min-h-screen">

    <aside class="fixed overflow-y-auto">
        <x-sidebar-siswa />
    </aside>

    {{-- KONTEN UTAMA --}}
    <div class="flex-1 ml-64 mr-20 min-h-screen">
        <div class="w-full mx-8 my-7">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Program favorit saya</h1>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($bookmarks as $program)
                    <x-katalog-card :item="$program" />
                @endforeach
            </div>
        </div>
    </div>
</div>