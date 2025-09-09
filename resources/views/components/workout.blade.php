@props(["id", "name", "sets", "reps", "incrSetFn", "decrSetFn", "incrRepFn", "decrRepFn", "delFn"])
<label
    data-id="workout-{{ $id }}"
    class="group relative block rounded-lg border border-gray-300 bg-white px-6 py-4 has-checked:outline-2 has-checked:-outline-offset-2 has-checked:outline-indigo-600 has-focus-visible:outline-3 has-focus-visible:-outline-offset-1 sm:flex sm:justify-between">
    <input type="radio" name="plan" value="hobby"
           class="w-0 h-0 appearance-none focus:outline-none"/>
    <span class="flex text-sm basis-2xl gap-6 items-center">
              <span class="font-medium text-gray-900 flex-4">{{ $name }}</span>
              <span class="flex items-center gap-2 flex-1">
                  <span class="text-xs">Sets:</span>
                  <x-counter :incrFn="$incrSetFn" :decrFn="$decrSetFn" :count="$sets"
                             buttonClasses="hidden group-has-checked:block text-gray-300 hover:text-indigo-600"/>
              </span>
              <span class="flex items-center gap-2 flex-1">
                  <span class="text-xs">Reps:</span>
                  <x-counter :incrFn="$incrRepFn" :decrFn="$decrRepFn" :count="$reps"
                             buttonClasses="hidden group-has-checked:block text-gray-300 hover:text-indigo-600"/>
              </span>
        <span class="flex justify-end flex-1 min-w-10">
                <button onclick="{{ $delFn }}"
                        class="hidden group-has-checked:block rounded-sm text-red-600 p-2 hover:text-red-50 hover:bg-red-600"
                        type="button"><svg
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


