<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="icon.jpg">

        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

        @vite('resources/css/app.css')

    </head>

    <body class="">

        <nav class="flex justify-between flex-row p-3  border-b border-gray-300 shadow-sm ">
            <!-- Left Section -->
            <div class="flex items-center">
                <h5 class="text-primary font-bold text-2xl mr-0 lg:mr-32">ONEUTM</h5>
                <div class="text-zinc-500 space-x-4">
                  <a href="" class="text-primary">Home</a>
                  <a href="" class="hover:text-primary">More</a>
                  <a href="" class="hover:text-primary">About</a>
                  <a href="{{ route('chat.index') }}" class="hover:text-primary">Chat</a> <!-- Chat button -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white   overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6   ">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
