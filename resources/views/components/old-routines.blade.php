@props(["workout_routines"])
<fieldset class="p-4 inline-flex flex-col gap-4 min-w-122 h-full" aria-label="My workouts">
    <h2 class="text-center px-4 text-2xl/9 font-base tracking-tight">Workouts for {{$workout_routines[0]["created_at"]->format("F j, Y")}}</h2>
    <div id="my-old-workouts" class="space-y-4 flex-1 min-h-0 overflow-auto">
        @php $previous = null; @endphp
        @foreach($workout_routines as $workout_routine)
            <x-old-workout :$workout_routine />
        @endforeach
    </div>
</fieldset>

