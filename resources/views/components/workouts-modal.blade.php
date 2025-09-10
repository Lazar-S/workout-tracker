@props(["workouts"])
<dialog id="workouts-modal" aria-labelledby="dialog-title"
        class="fixed inset-2 m-auto backdrop:bg-gray-600/50 rounded-md">
    <form id="create-workout-form" tabindex="0"
         class="rounded-md relative inline-flex flex-col gap-8 bg-white justify-center p-4 focus:outline-none">
        <div class="absolute top-0 right-0 pt-4 pr-4">
            <button id="workouts_modal_close_x" type="button"
                    class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-2 focus:outline-offset-2 focus:outline-indigo-600">
                <span class="sr-only">Close</span>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon"
                     aria-hidden="true" class="size-6">
                    <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
        <div class="flex items-start">
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                <h3 id="dialog-title" class="text-base font-semibold text-gray-900">Choose workout</h3>
                <div class="mt-2">
                    <p class="text-sm text-gray-500">Pick a workout you want to create and press create.</p>
                </div>
            </div>
        </div>
        <fieldset class="px-4">
            @foreach ($workouts as $workout)
                <label
                    class="group flex justify-between items-center border border-gray-200 p-4 first:rounded-tl-md first:rounded-tr-md last:rounded-br-md last:rounded-bl-md focus:outline-hidden has-checked:relative has-checked:border-indigo-200 has-checked:bg-indigo-50">
                    <span
                        class="block text-sm font-medium text-gray-900 group-has-checked:text-indigo-900 group-has-disabled:text-gray-300">{{ $workout["name"] }}</span>
                    <input type="radio" name="workout_id" value="{{ $workout["id"] }}"
                           class="relative size-4 appearance-none rounded-full border border-gray-300 bg-white before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-indigo-600 checked:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 forced-colors:appearance-auto forced-colors:before:hidden"/>
                </label>
            @endforeach
        </fieldset>
        <div class="flex gap-2 justify-end">
            <button type="submit"
                    class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 sm:ml-3 sm:w-auto">
                Create Workout
            </button>
            <button type="button" id="workouts_modal_close_cancel"
                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs inset-ring-1 inset-ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                Cancel
            </button>
        </div>
    </form>
    <script>
        function closeDialog() {
            const dialog = document.querySelector("#workouts-modal");
            if (dialog) dialog.close();
        }

        const closeX = document.querySelector("#workouts_modal_close_x");
        const closeCancel = document.querySelector("#workouts_modal_close_cancel");
        if (closeX) closeX.addEventListener("click", closeDialog);
        if (closeCancel) closeCancel.addEventListener("click", closeDialog);
    </script>
</dialog>
