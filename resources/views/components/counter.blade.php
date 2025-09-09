@props(["count", "buttonClasses", "incrFn", "decrFn"])
<span class="flex flex-col justify-center items-center flex-1 min-h-17 min-w-6">
    <button type="button" class="{{ $buttonClasses }}" onclick="{{ $incrFn }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
             class="lucide lucide-play-icon lucide-play">
            <path class="origin-center rotate-30"
                  d="M5 5a2 2 0 0 1 3.008-1.728l11.997 6.998a2 2 0 0 1 .003 3.458l-12 7A2 2 0 0 1 5 19z"/></svg>
    </button>
    <span>{{ $count }}</span>
    <button type="button" class="{{ $buttonClasses }}" onclick="{{ $decrFn }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
             class="lucide lucide-play-icon lucide-play">
            <path class="origin-center rotate-90"
                  d="M5 5a2 2 0 0 1 3.008-1.728l11.997 6.998a2 2 0 0 1 .003 3.458l-12 7A2 2 0 0 1 5 19z"/></svg>
    </button>
</span>
