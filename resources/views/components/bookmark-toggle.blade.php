<div>
    <button wire:click="toggle" class="text-red-500">
        @if($isBookmarked)
        <svg xmlns="http://www.w3.org/2000/svg" 
            fill="#facc15"
            viewBox="0 0 24 24" 
            stroke-width="1.7" 
            stroke="currentColor" 
            class="w-6 h-6">
            <path stroke-linecap="round" 
                stroke-linejoin="round" 
                d="M17.25 6.75V21L12 17.25 6.75 21V6.75a2.25 2.25 0 0 1 2.25-2.25h6a2.25 2.25 0 0 1 2.25 2.25z" />
        </svg>
        @else
        <svg xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24" 
            stroke-width="1.7" 
            stroke="currentColor" 
            class="w-6 h-6 text-yellow-500">
            <path stroke-linecap="round" 
                stroke-linejoin="round" 
                d="M17.25 6.75V21L12 17.25 6.75 21V6.75a2.25 2.25 0 0 1 2.25-2.25h6a2.25 2.25 0 0 1 2.25 2.25z" />
        </svg>

        @endif
    </button>
</div>