<?php

namespace App\Livewire\Siswa\Program;

use Livewire\Component;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;

class BookmarkToggle extends Component
{
    public $programId;
    public $isBookmarked;

    public function mount($programId){
        $this->programId = $programId;

        $this->isBookmarked = Bookmark::where('user_id', Auth::id())->where('program_id', $this->programId)->exists();
    }

    public function toggle() {
        if(!Auth::check()){
            return;
        }

        if($this->isBookmarked) {
            Bookmark::where('user_id', Auth::id())->where('program_id', $this->programId)->delete();
            $this->isBookmarked = false;
        }else{
            Bookmark::create([
                'user_id' => Auth::id(),
                'program_id' => $this->programId
            ]);

            $this->isBookmarked = true;
        }
    }
    public function render()
    {
        return view('components.bookmark-toggle');
    }
}
