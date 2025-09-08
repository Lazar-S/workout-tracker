<div class="flex flex-col group not-sm:absolute has-checked:h-full">
    <label class="inline-flex p-2 text-gray-600 sm:hidden">
        <input name="burger" class="invisible h-0 w-0" type="checkbox" />
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect class="transition-transform duration-200 rotate-0 translate-0 group-has-checked:rotate-45 group-has-checked:translate-x-[25%] group-has-checked:translate-y-[12%]" x="0" y="1" height="2" width="24" />
            <rect class="group-has-checked:hidden" x="0" y="9" height="2" width="24" />
            <rect class="transition-transform duration-200 rotate-0 translate-0 group-has-checked:-rotate-45 group-has-checked:translate-x-[-34%] group-has-checked:translate-y-[34%]" x="0" y="17" height="2" width="24" />
        </svg>
    </label>
    <div
        class="relative flex flex-col flex-1 gap-y-5 overflow-y-auto border-r border-gray-200 bg-white not-sm:not-group-has-checked:hidden">
        <div class="relative flex h-16 shrink-0 justify-center items-center px-4 text-gray-700 gap-4 select-none">
            <div class="ring-2 rounded-full p-2 -rotate-50">
                <x-icons.biceps-flexed size="20"/>
            </div>
            <div class="font-extrabold font-sans italic">
                <div>Workout</div>
                <div>Tracker</div>
            </div>
        </div>
        <nav class="relative flex flex-1 flex-col gap-6">
            <ul role="list" class="flex flex-col gap-1">
                <li>
                    <a href="#"
                       class="flex gap-x-3 rounded-md bg-gray-50 p-2 text-sm/6 font-semibold text-indigo-600 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="lucide lucide-notebook-pen-icon lucide-notebook-pen">
                            <path d="M13.4 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-7.4"/>
                            <path d="M2 6h4"/>
                            <path d="M2 10h4"/>
                            <path d="M2 14h4"/>
                            <path d="M2 18h4"/>
                            <path
                                d="M21.378 5.626a1 1 0 1 0-3.004-3.004l-5.01 5.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z"/>
                        </svg>
                        Tracker
                    </a>
                </li>
                <li>
                    <a href="#"
                       class="flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-700 hover:bg-gray-50 hover:text-indigo-600 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="lucide lucide-users-round-icon lucide-users-round">
                            <path d="M18 21a8 8 0 0 0-16 0"/>
                            <circle cx="10" cy="8" r="5"/>
                            <path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3"/>
                        </svg>
                        Followers
                    </a>
                </li>
                <li>
                    <a href="#"
                       class="flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-700 hover:bg-gray-50 hover:text-indigo-600 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="lucide lucide-search-icon lucide-search">
                            <path d="m21 21-4.34-4.34"/>
                            <circle cx="11" cy="11" r="8"/>
                        </svg>
                        Search
                    </a>
                </li>
            </ul>
            @auth
            <div class="border-t mx-2 border-gray-300"></div>
            <ul>
                <li>
                    <form action="/logout" method="POST">
                    @csrf
                    <button type="submit"
                       class="cursor-pointer flex w-full gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-700 hover:bg-gray-50 hover:text-indigo-600 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="lucide lucide-log-out-icon lucide-log-out">
                            <path d="m16 17 5-5-5-5"/>
                            <path d="M21 12H9"/>
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                        </svg>
                        Logout
                    </button>
                    </form>
                </li>
            </ul>
            @endauth
        </nav>
        @auth
        <div>
            <a href="#"
               class="flex items-center gap-x-4 px-4 py-3 text-sm/6 font-semibold text-gray-900 hover:bg-gray-50">
                <div class="flex items-center justify-center bg-gray-400 text-gray-100 size-8 rounded-full ring-2">
                    {{ strtoupper(Auth::user()->first_name[0]) }} {{ strtoupper(Auth::user()->last_name[0]) }}
                </div>
                <span class="sr-only">Your profile</span>
                <span aria-hidden="true">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
            </a>
        </div>
        @endauth
    </div>
</div>
