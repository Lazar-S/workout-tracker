<x-layout title="Tracker">
    <div class="flex h-full">
    <x-sidebar />
    <main class="flex justify-center flex-1">
        <x-routine :$workouts :$workout_routines />
    </main>
    </div>
</x-layout>
