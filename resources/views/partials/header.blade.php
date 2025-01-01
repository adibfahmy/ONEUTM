<!-- resources/views/partials/header.blade.php -->
<nav class="flex justify-between flex-row p-3 border-b border-gray-300 shadow-sm">
    <!-- Left Section -->
    <div class="flex items-center">
        <!-- Clickable ONEUTM -->
        <a href="{{ route('home') }}" class="text-primary font-bold text-2xl mr-0 lg:mr-32">
            ONEUTM
        </a>
        <div class="text-zinc-500 space-x-4">
            <a href="{{ route('home') }}" class="text-primary">Home</a>
            <a href="#" class="hover:text-primary">More</a>
            <a href="#" class="hover:text-primary">About</a>
            <a href="{{ route('chat.index') }}" class="hover:text-primary">Chat</a> <!-- Chat button -->
            <a href="{{ route('faq.index') }}" class="hover:text-primary">FAQ</a>
        </div>
    </div>

    <!-- Right Section -->
    <div class="text-secondary inline-flex items-center space-x-4">
        @auth
            <!-- Show when the user is authenticated -->
            <div x-data="{ open: false }" class="text-secondary inline-flex items-center relative">
                <!-- Dropdown button -->
                <button @click="open = !open"
                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white  dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-user mr-2">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                    </svg>
                    <span>{{ Auth::user()->name }}</span>
                    <div class="ms-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>

                <!-- Dropdown menu -->
                <div x-show="open" x-transition @click.away="open = false"
                    class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5  top-10">
                    <div class="py-1">
                        <a href="{{ route('profile.edit') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ __('Profile') }}</a>
                            <a href="{{ route('purchase-history') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ __('Purchase History') }}</a> <!-- Added Purchase History link -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left">{{ __('Log Out') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        @endauth

        @guest
            <!-- Show when the user is not authenticated -->
            <a href="{{ route('login') }}" class="hover:text-primary">Login</a>
            <a href="{{ route('register') }}" class="hover:text-primary">Register</a>
        @endguest

    </div>
</nav>
