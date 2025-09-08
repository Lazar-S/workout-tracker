<x-layout title="Registration">
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8 gap-10">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm text-gray-900 flex flex-col justify-center items-center gap-6">
            <div class="ring-3 rounded-full p-2 -rotate-50"><x-icons.biceps-flexed size="48"/></div>
            <h2 class="text-center text-2xl/9 font-bold tracking-tight">Create an account</h2>
        </div>
        <div class="sm:mx-auto sm:w-full sm:max-w-sm md:max-w-md bg-gray-100 p-6 rounded-2xl">
            <form action="/register" method="POST" class="flex flex-col">
                @csrf
                <div class="flex gap-3">
                    <div class="flex flex-col flex-1 gap-1">
                        <label for="first_name" class="block text-sm font-medium text-gray-900 px-1">First name</label>
                        <input id="first_name" type="text" name="first_name" required autocomplete="first_name"
                               placeholder="John" value="{{ old('first_name') }}"
                               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
                        <div class="text-sm text-red-500 px-1 min-h-lh">@error('first_name') {{$message}} @enderror</div>
                    </div>
                    <div class="flex flex-col flex-1 gap-1">
                        <label for="last_name" class="block text-sm font-medium text-gray-900 px-1">Last name</label>
                        <input id="last_name" type="text" name="last_name" required autocomplete="last_name"
                               placeholder="Doe" value="{{ old('last_name') }}"
                               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
                        <div class="text-sm text-red-500 px-1 min-h-lh">@error('last_name') {{$message}} @enderror</div>
                    </div>
                </div>
                <div class="flex flex-col gap-1">
                    <label for="username" class="block text-sm font-medium text-gray-900 px-1">Username</label>
                    <input id="username" type="text" name="username" required autocomplete="username"
                           placeholder="Doe" value="{{ old('username') }}"
                           class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
                    <div class="text-sm text-red-500 px-1 min-h-lh">@error('username') {{$message}} @enderror</div>
                </div>
                <div class="flex flex-col gap-1">
                    <label for="email" class="block text-sm/6 font-medium text-gray-900 px-1">Email address</label>
                    <input id="email" type="email" name="email" required autocomplete="email"
                           placeholder="john.doe@gmail.com"  value="{{ old('email') }}"
                           class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
                    <div class="text-sm text-red-500 px-1 min-h-lh">@error('email') {{$message}} @enderror</div>
                </div>
                <div class="flex flex-col gap-1">
                    <label for="password" class="block text-sm/6 font-medium text-gray-900 px-1">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                           placeholder="******"
                           class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
                    <div class="text-sm text-red-500 px-1 min-h-lh">@error('password') {{$message}} @enderror</div>
                </div>
                <div class="flex flex-col gap-1">
                    <label for="password_confirmation"
                           class="block text-sm/6 font-medium text-gray-900 px-1">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                           placeholder="******"
                           autocomplete="current-password"
                           class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
                    <div class="text-sm text-red-500 px-1 min-h-lh">@error('password_confirmation') {{$message}} @enderror</div>
                </div>
                <button type="submit"
                        class="cursor-pointer mt-2 flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Create account
                </button>
                <p class="mt-4 text-center text-sm/6 text-gray-500">
                    Already have an account?
                    <a href="/login" class="font-semibold text-indigo-600 hover:text-indigo-500">Log in</a>
                </p>
            </form>

        </div>
    </div>
</x-layout>
