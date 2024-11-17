<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Catalog</title>
        @vite('resources/css/app.css')
    </head>
    <body class="antialiased">
        <!-- Header and navigation -->
        <div class="rounded text-black bg-gray-100 border-gray-50 border-4 h-16 flex items-center px-4 w-full">
            <p class="font-mono text-2xl px-4 py-3 mr-10">ONEUTM</p>
            <button class="px-4 py-2 text-black rounded hover:bg-white">Parcel Pickup</button>
            <button class="px-4 py-2 text-black rounded hover:bg-white">Market Place</button>
            <button class="px-4 py-2 text-blue-500 rounded hover:bg-white ml-auto">Login/Register</button>
        </div>

        <div class="container mx-auto px-4 py-8">
            <p class="font-mono text-2xl font-bold mb-6">Items</p>

            @if($items->isEmpty())
                <!-- Show Add Product Button if catalog is empty -->
                <div class="text-center py-4">
                    <a href="{{ route('marketplace.create') }}" class="px-6 py-3 bg-green-500 text-white rounded hover:bg-green-600">
                        Add a Product
                    </a>
                </div>
            @else
                <!-- Display catalog items if available -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($items as $item)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                            <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-semibold">{{ $item->name }}</h3>
                                <p class="text-gray-600">{{ $item->description }}</p>
                                <p class="text-xl font-bold">${{ $item->price }}</p>
                                <button class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">View Details</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </body>
</html>
