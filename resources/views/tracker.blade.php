<x-layout title="Tracker">
    @if(session('status'))
        <div class="text-sm px-1 py-2 min-h-lh text-center  bg-black text-white">{{session('status')}}</div>
    @endif
    <div class="flex h-full">
    <x-sidebar />
    <main class="flex justify-center flex-1">
        <x-routine :$workouts :$workout_routines />
    </main>
    </div>
</x-layout>
