<?php

namespace App\Livewire\Siswa\Program;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Bookmark;

class BookmarkList extends Component
{
    public function render()
    {
        $bookmarks = Auth::user()->bookmarkedPrograms()->with('kategoriProgram')->get();
        return view('livewire.siswa.program.bookmark-list', compact('bookmarks'));
    }
}
