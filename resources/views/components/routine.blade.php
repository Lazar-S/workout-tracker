@props(["workouts"])
<fieldset class="p-4 inline-flex flex-col gap-4 min-w-122 h-full" aria-label="My workouts">
    <h2 class="text-center px-4 text-2xl/9 font-base tracking-tight">My workouts</h2>
    <div class="flex items-center justify-end gap-3 px-2">
        <label id="make-public" class="text-sm font-medium text-gray-900">Make public</label>
        <div
            class="group relative inline-flex w-11 shrink-0 rounded-full bg-gray-200 p-0.5 inset-ring inset-ring-gray-900/5 outline-offset-2 outline-indigo-600 transition-colors duration-200 ease-in-out has-checked:bg-indigo-600 has-focus-visible:outline-2">
            <span
                class="size-5 rounded-full bg-white shadow-xs ring-1 ring-gray-900/5 transition-transform duration-200 ease-in-out group-has-checked:translate-x-5"></span>
            <input type="checkbox" name="public" class="absolute inset-0 appearance-none focus:outline-hidden"/>
        </div>
    </div>
    <button
        id="add-workout"
        type="button"
        class="rounded-sm bg-indigo-600 p-4 text-base font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
    >Add a workout
    </button>
    <div id="my-workouts" class="space-y-4 flex-1 min-h-0 overflow-auto">
    </div>
    <x-workouts-modal :$workouts/>
    <script>
        async function incrementSet(e) {
            const incrBtn = e.currentTarget;
            const output = incrBtn.nextElementSibling;
            const oldSets = Number(output.textContent);
            const workoutElement = incrBtn.closest("label");
            const id = workoutElement && workoutElement.dataset.id;
            incrBtn.disabled = true;
            const { sets } = await updateWorkout(id, { sets: oldSets + 1 })
            output.textContent = "" + sets;
            incrBtn.disabled = false;
        }

        async function decrementSet(e) {
            const decrBtn = e.currentTarget;
            const output = decrBtn.previousElementSibling;
            const oldSets = Number(output.textContent);
            const workoutElement = decrBtn.closest("label");
            const id = workoutElement && workoutElement.dataset.id;
            decrBtn.disabled = true;
            const { sets } = await updateWorkout(id, { sets: oldSets - 1 })
            output.textContent = "" + sets;
            if (sets > 0) decrBtn.disabled = false;
        }

        async function incrementRep(e) {
            const incrBtn = e.currentTarget;
            const output = incrBtn.nextElementSibling;
            const oldReps = Number(output.textContent);
            const workoutElement = incrBtn.closest("label");
            const id = workoutElement && workoutElement.dataset.id;
            incrBtn.disabled = true;
            const { reps } = await updateWorkout(id, { reps: oldReps + 1 })
            output.textContent = "" + reps;
            incrBtn.disabled = false;
        }

        async function decrementRep(e) {
            const decrBtn = e.currentTarget;
            const output = decrBtn.previousElementSibling;
            const oldReps = Number(output.textContent);
            const workoutElement = decrBtn.closest("label");
            const id = workoutElement && workoutElement.dataset.id;
            decrBtn.disabled = true;
            const { reps } = await updateWorkout(id, { reps: oldReps - 1 })
            output.textContent = "" + reps;
            if (reps > 0) decrBtn.disabled = false;
        }

        async function deleteWorkout(e) {
            const delBtn = e.currentTarget;
            const workoutElement = e.currentTarget.closest("label");
            const id = workoutElement && workoutElement.dataset.id;
            delBtn.disabled = true;
            await removeWorkout(id);
            if (workoutElement) workoutElement.remove();
        }

        function createWorkoutElement(id, workoutId, name, sets, reps) {
            const template = document.createElement("template");
            template.innerHTML = `{{ view(
                "components.workout", [
                    "id" => "\${id}",
                    "workout_id" => "\${workoutId}",
                    "name" => "\${name}",
                    "sets" => "\${sets}",
                    "reps" => "\${reps}",
                    "incrSetFn" => "incrementSet(event)",
                    "decrSetFn" => "decrementSet(event)",
                    "incrRepFn" => "incrementRep(event)",
                    "decrRepFn" => "decrementRep(event)",
                    "delFn" => "deleteWorkout(event)"
                ]) }}`;
            return template.content;
        }

        document.querySelector("#add-workout").addEventListener("click", () => {
            const dialog = document.querySelector("#workouts-modal");

            const myWorkouts = document.querySelector("#my-workouts");
            if (myWorkouts && dialog) {
                dialog.querySelectorAll(`[type="radio"][disabled]`).forEach(node => {
                    node.disabled = false;
                });
                myWorkouts.querySelectorAll(`[data-workout-id]`).forEach(node => {
                    const element = dialog.querySelector(`[type="radio"][value="${ node.dataset.workoutId }"]`);
                    if (element) element.disabled = true;
                });
            }

            if (dialog) dialog.showModal();
        });

        document.querySelector("#make-public").addEventListener("click", async (e) => {
            // maybe disable button while the change is happening
            const button = e.currentTarget;
            button.disabled = true;
            // const response = await fetch();
            // enable button after response
            button.disabled = false;
        });

        /**
         * fetch("url", {
         *   method:"POST",
         *   credentials: "include",
         *   headers: {
         *     "Accept": "application/json",
         *     "Content-Type": "application/json"
         *   },
         *   body: JSON.stringify({ the: "data" })
         *  }
         */


        (async function () {
            const response = await fetch("/api/routines", {
                method: "GET",
                credentials: "include",
                headers: { "Accept": "application/json" }
            });
            const json = await response.json(); // json is an object or array, depending on what your response body is
            /**
             * { routines: { id: number; workout_name: string; sets: number; reps; number;  }[] }
             */
            const newElements = json.routines.map(({ id, workout_id, workout_name, sets, reps }) => {
                return createWorkoutElement(id, workout_id, workout_name, sets, reps);
            });
            const output = document.querySelector("#my-workouts");
            if (output) output.append(...newElements)
        })();

        function getCookieValue(name) {
            return document.cookie.match('(^|;)\\s*' + name + '\\s*=\\s*([^;]+)')?.pop() || "";
        }

        async function createWorkout(workoutId) {
            await fetch("/sanctum/csrf-cookie");
            const token = getCookieValue("XSRF-TOKEN");
            const response = await fetch("/api/routines", {
                method: "POST",
                credentials: "include",
                headers: {
                    "Accept": "application/json",
                    "Content-Type": "application/json",
                    "X-XSRF-TOKEN": token,
                },
                body: JSON.stringify({ workout_id: workoutId })
            });
            if (!response.ok) throw new Error("Failed to create routine");
            const { id, workout_id, workout_name, sets, reps } = await response.json();
            return { id, workout_id, workout_name, sets, reps };
        }

        const createWorkoutForm = document.querySelector("#create-workout-form");
        if (createWorkoutForm) createWorkoutForm.addEventListener("submit", async (e) => {
            e.preventDefault();
            const form = e.currentTarget;
            const workoutId = new FormData(form).get("workout_id");
            if (!workoutId) return;

            const btn = form.querySelector(`[type="submit"]`);
            if (btn) btn.disabled = true;

            try {
                const { id, workout_id, workout_name, sets, reps } = await createWorkout(Number(workoutId));
                const newElement = createWorkoutElement(id, workout_id, workout_name, sets, reps);
                const output = document.querySelector("#my-workouts");
                if (output) output.append(newElement);
            } catch(e) {
                console.warn(e.message);
            }

            if (btn) btn.disabled = false;
            const dialog = document.querySelector("#workouts-modal");
            dialog.close();
        });

        // data is { sets?: number; reps?: number; }
        async function updateWorkout(workoutId, data) {
            await fetch("/sanctum/csrf-cookie");
            const token = getCookieValue("XSRF-TOKEN");
            const response = await fetch(`/api/routines/${workoutId}`, {
                method: "PATCH",
                credentials: "include",
                headers: {
                    "Accept": "application/json",
                    "Content-Type": "application/json",
                    "X-XSRF-TOKEN": token,
                },
                body: JSON.stringify(data)
            });
            if (!response.ok) throw new Error("Failed to update routine");
            const { id, workout_id, workout_name, sets, reps } = await response.json();
            return { id, workout_id, workout_name, sets, reps };
        }

        async function removeWorkout(workoutId) {
            await fetch("/sanctum/csrf-cookie");
            const token = getCookieValue("XSRF-TOKEN");
            const response = await fetch(`/api/routines/${workoutId}`, {
                method: "DELETE",
                credentials: "include",
                headers: { "Accept": "application/json", "X-XSRF-TOKEN": token }
            });
            if (!response.ok) throw new Error("Failed to update routine");
        }
    </script>
</fieldset>
