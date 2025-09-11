<x-layout title="History">
    <div class="flex h-full">
        <x-sidebar />
        <main class="flex justify-center flex-1">
            <x-old-routines :$workout_routines />
        </main>
    </div>
</x-layout>
