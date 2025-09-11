@props(["workout_routines"])
<fieldset class="p-4 inline-flex flex-col gap-4 min-w-122 h-full" aria-label="My workouts">
    <h2 class="text-center px-4 text-2xl/9 font-base tracking-tight">My old workouts</h2>
    <div id="my-old-workouts" class="flex flex-col items-center space-y-2 flex-1 min-h-0 overflow-auto">
        @php $previous = null; @endphp
        @foreach($workout_routines as $workout_routine)
            @if (!isset($previous) || !$workout_routine["created_at"]->isSameDay($previous["created_at"]))
                <a class="font-semibold text-indigo-600 hover:text-indigo-500 px-1" href="?date={{urlencode($workout_routine["created_at"]->format("Y-m-d"))}}">{{{$workout_routine["created_at"]->format("F j, Y")}}}</a>
            @endif
            @php $previous = $workout_routine; @endphp
        @endforeach
    </div>
</fieldset>


