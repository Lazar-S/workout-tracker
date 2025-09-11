@props(["workout_routines"])
<fieldset class="p-4 inline-flex flex-col gap-4 min-w-122 h-full" aria-label="My workouts">
    <h2 class="text-center px-4 text-2xl/9 font-base tracking-tight">My old workouts</h2>
    <div id="my-old-workouts" class="space-y-4 flex-1 min-h-0 overflow-auto">
        @php $previous = null; @endphp
        @foreach($workout_routines as $workout_routine)
            @if (!isset($previous) || !$workout_routine["created_at"]->isSameDay($previous["created_at"]))
                <div class="flex items-center my-6">
                    <div class="flex-1 border-t border-gray-300"></div>
                    <span class="mx-4 text-gray-600 text-sm">
                        {{ $workout_routine["created_at"]->format("F j, Y") }}
                    </span>
                    <div class="flex-1 border-t border-gray-300"></div>
                </div>
            @endif
            <x-old-workout :$workout_routine />
            @php $previous = $workout_routine; @endphp
        @endforeach
    </div>
</fieldset>

