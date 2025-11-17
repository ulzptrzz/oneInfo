<div class="max-w-5xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Program Favorit Saya</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach($bookmarks as $program)
        <x-katalog-card :item="$program" />
        @endforeach
    </div>
</div>