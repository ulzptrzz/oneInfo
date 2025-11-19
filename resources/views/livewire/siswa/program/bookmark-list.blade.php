<div>
    <div class="flex min-h-screen">
        <x-sidebar-siswa />
        <div class="max-w-6xl mx-auto p-6">
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