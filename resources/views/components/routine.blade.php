@props(["workouts", "workout_routines"])
<fieldset class="p-4 inline-flex flex-col gap-4 min-w-122 h-full" aria-label="My workouts">
    <h2 class="text-center px-4 text-2xl/9 font-base tracking-tight">My workouts</h2>
    <div class="flex items-center justify-end gap-3 px-2">
        <label class="text-sm font-medium text-gray-900">Make public</label>
        <div
            class="group relative inline-flex w-11 shrink-0 rounded-full bg-gray-200 p-0.5 inset-ring inset-ring-gray-900/5 outline-offset-2 outline-indigo-600 transition-colors duration-200 ease-in-out has-checked:bg-indigo-600 has-focus-visible:outline-2">
            <span
                class="size-5 rounded-full bg-white shadow-xs ring-1 ring-gray-900/5 transition-transform duration-200 ease-in-out group-has-checked:translate-x-5"></span>
            <input id="make-public" type="checkbox" name="public" class="absolute inset-0 appearance-none focus:outline-hidden"/>
        </div>
    </div>
    <button
        id="add-workout"
        type="button"
        class="rounded-sm bg-indigo-600 p-4 text-base font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
    >Add a workout
    </button>
    <div id="my-workouts" class="space-y-4 flex-1 min-h-0 overflow-auto">
        @foreach($workout_routines as $workout_routine)
            <x-workout :$workout_routine />
        @endforeach
    </div>
    <x-workouts-modal :$workouts/>
</fieldset>
