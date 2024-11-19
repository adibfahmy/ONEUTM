<!-- resources/views/partials/header.blade.php -->
<nav class="flex justify-between flex-row p-3 border-b border-gray-300 shadow-sm">
    <!-- Left Section -->
    <div class="flex items-center">
        <h5 class="text-primary font-bold text-2xl mr-0 lg:mr-32">ONEUTM</h5>
        <div class="text-zinc-500 space-x-4">
            <a href="/dashboard" class="text-primary">Home</a>
            <a href="#" class="hover:text-primary">More</a>
            <a href="#" class="hover:text-primary">About</a>
        </div>
    </div>

    <!-- Right Section -->
    <div class="text-secondary inline-flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
        </svg>
        <a href="{{ route('profile.edit') }}">Profile</a>
    </div>
</nav>