<x-layout title="Login">
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8 gap-10">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm text-gray-900 flex flex-col justify-center items-center gap-6">
            <div class="ring-3 rounded-full p-2">
                <x-icons.biceps-flexed size="48"/>
            </div>
            <h2 class="text-center text-2xl/9 font-bold tracking-tight">Reset your password</h2>
        </div>
        <div class="sm:mx-auto sm:w-full sm:max-w-sm md:max-w-md bg-gray-100 p-6 rounded-2xl">
            <form action="/reset-password" method="POST" class="flex flex-col gap-2">
                @csrf
                <div class="flex flex-col gap-1">
                    <label for="email" class="block text-sm/6 font-medium text-gray-900 px-1">Email address</label>
                    <input id="email" type="email" name="email" required autocomplete="email"
                           placeholder="john.doe@gmail.com"
                           class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
                    <div class="text-sm text-red-500 px-1 min-h-lh"></div>
                </div>
                <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Send email
                </button>
            </form>
        </div>
    </div>
</x-layout>
