<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $item->name }} - Details</title>
    @vite('resources/css/app.css')
</head>
<body class="antialiased">

    <!-- Header -->
    @include('partials.header')

    <div class="container mx-auto px-4 py-8">
        <!-- Item Details -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex flex-col md:flex-row items-center">
                <!-- Image -->
                <img src="{{ asset($item->image_url) }}" alt="{{ $item->name }}" class="w-full md:w-1/2 h-64 object-cover rounded-lg">
                
                <!-- Details -->
                <div class="mt-6 md:mt-0 md:ml-6">
                    <h1 class="text-2xl font-bold text-slate-900">{{ $item->name }}</h1>
                    <p class="mt-2 text-gray-600">{{ $item->description }}</p>
                    <p class="mt-4 text-xl font-bold text-slate-500">RM{{ $item->price }}</p>

                    <!-- Action Buttons -->
                    <div class="mt-6 flex space-x-4">
                        <button class="px-6 py-2 bg-green-500 text-white rounded hover:bg-green-600">Buy Now</button>
                        <a href="{{ route('marketplace.marketindex') }}" class="px-6 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Back to Catalog</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
