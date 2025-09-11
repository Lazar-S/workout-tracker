<x-layout title="History">
    <div class="flex h-full">
        <x-sidebar />
        <main class="flex justify-center flex-1">
            @if($view === "all")
                <x-old-routine-dates :$workout_routines />
            @else
                <x-old-routines :$workout_routines />
            @endif
        </main>
    </div>
</x-layout>
