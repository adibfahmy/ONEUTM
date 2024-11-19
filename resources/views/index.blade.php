<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="icon.jpg">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

@include('partials.header')

<main class="flex min-h-96 flex-col justify-center items-center">
    <h1 class="text-4xl text-primary font-bold py-3">ONEUTM</h1>
    <p class="text-zinc-600 text-center">One stop Hub for generating <br>side income through a wide range of activities
    </p>
    <a href="" class="text-secondary hover:text-cyan-500  hover:cursor-pointer">
        <p class="mt-2">
            Learn More
        </p>
    </a>
</main>

<div class="flex justify-center items-center min-h-48 pb-24">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-24 max-w-4xl">
        <!-- Marketplace -->
        <div class="flex items-start space-x-4">
            <div class="bg-redIconColor p-3 rounded-lg">
                <i class="text-white"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-bag">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M6.331 8h11.339a2 2 0 0 1 1.977 2.304l-1.255 8.152a3 3 0 0 1 -2.966 2.544h-6.852a3 3 0 0 1 -2.965 -2.544l-1.255 -8.152a2 2 0 0 1 1.977 -2.304z" />
                        <path d="M9 11v-5a3 3 0 0 1 6 0v5" />
                    </svg></i>
            </div>
            <div>
                <a href="{{ route('marketplace.marketindex') }}"
                    class="text-xl text-primary font-semibold mb-1">Marketplace</a>
                <p class="text-gray-600 text-sm text-justify">
                    Your one-stop shop for everything you need. Discover a wide range of products and services from
                    trusted sellers, all in one convenient place.
                </p>
            </div>
        </div>

        <!-- Parcel Pickup -->
        <div class="flex items-start space-x-4">
            <div class="bg-redIconColor p-3 rounded-lg">
                <i class="text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-packages">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M7 16.5l-5 -3l5 -3l5 3v5.5l-5 3z" />
                        <path d="M2 13.5v5.5l5 3" />
                        <path d="M7 16.545l5 -3.03" />
                        <path d="M17 16.5l-5 -3l5 -3l5 3v5.5l-5 3z" />
                        <path d="M12 19l5 3" />
                        <path d="M17 16.5l5 -3" />
                        <path d="M12 13.5v-5.5l-5 -3l5 -3l5 3v5.5" />
                        <path d="M7 5.03v5.455" />
                        <path d="M12 8l5 -3" />
                    </svg>
                </i>
            </div>
            <div>
                <h2 class="text-xl text-primary font-semibold mb-1">Parcel Pickup</h2>
                <p class="text-gray-600 text-sm text-justify">
                    Conveniently pick up your packages at your preferred location. No more missed deliveries or long
                    wait times.
                </p>
            </div>
        </div>

        <!-- Laundry Services -->
        <div class="flex items-start space-x-4">
            <div class="bg-redIconColor p-3 rounded-lg ">
                <i class="text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-wash-machine">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M5 3m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" />
                        <path d="M12 14m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                        <path d="M8 6h.01" />
                        <path d="M11 6h.01" />
                        <path d="M14 6h2" />
                        <path d="M8 14c1.333 -.667 2.667 -.667 4 0c1.333 .667 2.667 .667 4 0" />
                    </svg>
                </i>
            </div>
            <div>
                <h2 class="text-xl text-primary font-semibold mb-1">Laundry Services</h2>
                <p class="text-gray-600 text-sm text-justify">
                    Let us handle your laundry while you focus on what matters. We'll pick up your dirty clothes, wash,
                    dry, and fold them, then deliver them back to your door.
                </p>
            </div>
        </div>

        <!-- Student Grab -->
        <div class="flex items-start space-x-4">
            <div class="bg-redIconColor p-3 rounded-lg">
                <i class="text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-car">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M5 17h-2v-6l2 -5h9l4 5h1a2 2 0 0 1 2 2v4h-2m-4 0h-6m-6 -6h15m-6 0v-5" />
                    </svg>
                </i>
            </div>
            <div>
                <h2 class="text-xl text-primary font-semibold mb-1">Student Grab</h2>
                <p class="text-gray-600 text-sm text-justify">
                    Reliable and affordable transportation for students. We provide safe and comfortable rides to and
                    from school, extracurricular activities, and more.
                </p>
            </div>
        </div>
    </div>
</div>

</body>

<html>
