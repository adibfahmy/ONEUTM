<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body class="font-sans text-gray-900 antialiased bg-tertiary">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <!-- Centered Logo/Link -->
        <div class="mb-6">
            <a href="{{ route('home') }}" class="text-primary font-bold text-3xl">
                ONEUTM
            </a>
        </div>

        <!-- Content -->
        <div class="w-full sm:max-w-md px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
