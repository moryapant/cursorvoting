<nav x-data="{ open: false }" class="text-white bg-black">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <a href="{{ route('home') }}"
                        class="text-xl font-bold text-white transition duration-150 hover:text-indigo-400">Bollywood
                        Polls</a>
                </div>
                <div class="hidden md:block">
                    <div class="flex items-baseline ml-10 space-x-4">
                        <a href="{{ route('home') }}"
                            class="{{ request()->routeIs('home') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} px-3 py-2 rounded-md text-sm font-medium transition duration-150">Home</a>
                        <a href="{{ route('polls.index') }}"
                            class="{{ request()->routeIs('polls.index') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} px-3 py-2 rounded-md text-sm font-medium transition duration-150">Polls</a>
                        <a href="{{ route('polls.archive') }}"
                            class="{{ request()->routeIs('polls.archive') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} px-3 py-2 rounded-md text-sm font-medium transition duration-150">Archive</a>
                        <a href="{{ route('leaderboard') }}"
                            class="{{ request()->routeIs('leaderboard') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} px-3 py-2 rounded-md text-sm font-medium transition duration-150">Leaderboard</a>
                        @auth
                            @if (auth()->user()->email === 'morya123@gmail.com')
                                <a href="{{ route('polls.create') }}"
                                    class="{{ request()->routeIs('polls.create') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} px-3 py-2 rounded-md text-sm font-medium transition duration-150">Create
                                    Poll</a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
            <div class="hidden md:block">
                <div class="flex items-center ml-4 md:ml-6">
                    @auth
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="flex items-center text-sm font-medium text-gray-300 transition duration-150 ease-in-out hover:text-white focus:outline-none focus:text-white">
                                    <div>{{ Auth::user()->name }}</div>
                                    <div class="ml-1">
                                        <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link href="{{ route('profile.show') }}" class="text-gray-700">
                                    {{ __('Profile') }}
                                </x-dropdown-link>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link href="{{ route('logout') }}" class="text-gray-700"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-3 py-2 text-sm font-medium text-gray-300 transition duration-150 rounded-md hover:bg-gray-700 hover:text-white">Log
                            in</a>
                        <a href="{{ route('register') }}"
                            class="px-3 py-2 text-sm font-medium text-gray-300 transition duration-150 rounded-md hover:bg-gray-700 hover:text-white">Register</a>
                    @endauth
                </div>
            </div>
            <div class="flex -mr-2 md:hidden">
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 text-gray-400 rounded-md hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{ 'block': open, 'hidden': !open }" class="md:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="{{ route('home') }}"
                class="{{ request()->routeIs('home') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} block px-3 py-2 rounded-md text-base font-medium transition duration-150">Home</a>
            <a href="{{ route('polls.index') }}"
                class="{{ request()->routeIs('polls.index') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} block px-3 py-2 rounded-md text-base font-medium transition duration-150">Polls</a>
            <a href="{{ route('polls.archive') }}"
                class="{{ request()->routeIs('polls.archive') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} block px-3 py-2 rounded-md text-base font-medium transition duration-150">Archive</a>
            <a href="{{ route('leaderboard') }}"
                class="{{ request()->routeIs('leaderboard') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} block px-3 py-2 rounded-md text-base font-medium transition duration-150">Leaderboard</a>
            @auth
                @if (auth()->user()->email === 'morya123@gmail.com')
                    <a href="{{ route('polls.create') }}"
                        class="{{ request()->routeIs('polls.create') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} block px-3 py-2 rounded-md text-base font-medium transition duration-150">Create
                        Poll</a>
                @endif
            @endauth
        </div>
        <div class="pt-4 pb-3 border-t border-gray-700">
            @auth
                <div class="flex items-center px-5">
                    <div class="flex-shrink-0">
                        <svg class="w-10 h-10 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium leading-none text-white">{{ Auth::user()->name }}</div>
                        <div class="text-sm font-medium leading-none text-gray-400">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <div class="px-2 mt-3 space-y-1">
                    <a href="{{ route('profile.show') }}"
                        class="block px-3 py-2 text-base font-medium text-gray-400 transition duration-150 rounded-md hover:text-white hover:bg-gray-700">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                            class="block px-3 py-2 text-base font-medium text-gray-400 transition duration-150 rounded-md hover:text-white hover:bg-gray-700"
                            onclick="event.preventDefault(); this.closest('form').submit();">Log Out</a>
                    </form>
                </div>
            @else
                <div class="px-2 mt-3 space-y-1">
                    <a href="{{ route('login') }}"
                        class="block px-3 py-2 text-base font-medium text-gray-400 transition duration-150 rounded-md hover:text-white hover:bg-gray-700">Log
                        in</a>
                    <a href="{{ route('register') }}"
                        class="block px-3 py-2 text-base font-medium text-gray-400 transition duration-150 rounded-md hover:text-white hover:bg-gray-700">Register</a>
                </div>
            @endauth
        </div>
    </div>
</nav>
