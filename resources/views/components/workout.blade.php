@props(["workout_routine", "selected"])
<div class="group flex flex-1">
    <input id="routine_{{$workout_routine['id']}}" type="radio" name="workout"
           class="w-0 h-0 appearance-none focus:outline-none" @if($selected) checked @endif />
    <form method="POST" action="/update-routine" class="flex flex-1">
        @csrf
        <input type="hidden" name="routine_id" value="{{$workout_routine['id']}}">
        <label
            for="routine_{{$workout_routine['id']}}"
            data-id="{{ $workout_routine['id'] }}"
            data-workout-id="{{ $workout_routine['workout_id'] }}"
            class="relative flex flex-1 rounded-lg border border-gray-300 bg-white px-6 py-4 group-has-checked:outline-2 group-has-checked:-outline-offset-2 group-has-checked:outline-indigo-600 group-has-focus-visible:outline-3 group-has-focus-visible:-outline-offset-1">
            <span class="flex text-sm basis-2xl gap-6 items-center">
              <span class="font-medium text-gray-900 flex-4">{{ $workout_routine['workout_name'] }}</span>
              <span class="flex items-center gap-2 flex-1">
                  <span class="text-xs">Sets:</span>
                  <input type="hidden" name="sets" value="{{$workout_routine['sets']}}">
                  <x-counter name="sets" :count="$workout_routine['sets']"
                             buttonClasses="hidden group-has-checked:block disabled:text-gray-300 text-indigo-600 hover:text-indigo-500"/>
              </span>
              <span class="flex items-center gap-2 flex-1">
                  <span class="text-xs">Reps:</span>
                  <input type="hidden" name="reps" value="{{$workout_routine['reps']}}">
                  <x-counter name="reps" :count="$workout_routine['reps']"
                             buttonClasses="hidden group-has-checked:block disabled:text-gray-300 text-indigo-600 hover:text-indigo-500"/>
              </span>
        <span class="flex justify-end flex-1 min-w-10">
                <input type="hidden" name="delete" value="false">
                <button
                    data-action="delete"
                    class="hidden group-has-checked:block rounded-sm text-red-600 disabled:text-gray-300 p-2 not-disabled:hover:text-red-50 not-disabled:hover:bg-red-600"
                    type="submit"><svg
                        xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="lucide lucide-trash2-icon lucide-trash-2"><path
                            d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path
                            d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg></button>
            </span>
        </span>
        </label>
        <script>
            {
                const formElement = document.currentScript.parentElement;
                formElement.addEventListener("submit", e => {
                    e.preventDefault();

                    const form = e.currentTarget;
                    const btn = e.submitter;
                    const action = btn.dataset.action;
                    let name, input;
                    switch (action) {
                        case "increment":
                            name = btn.dataset.name;
                            input = form.querySelector(`input[name="${ name }"]`);
                            if (input) input.value = Number(input.value) + 1;
                            console.log(input);
                            break;
                        case "decrement":
                            name = btn.dataset.name;
                            input = form.querySelector(`input[name="${ name }"]`);
                            if (input) input.value = Number(input.value) - 1;
                            break;
                        case "delete":
                            input = form.querySelector(`input[name="${ action }"]`);
                            if (input) input.value = "true";
                            break
                    }

                    form.submit();
                });
            }
        </script>
    </form>
</div>


