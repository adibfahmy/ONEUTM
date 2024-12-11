<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
</head>

<body class="antialiased">

    <!-- Header -->
    @include('partials.header')

    <div class="container mx-auto px-4 py-8">
        <!-- Item Details -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex flex-col md:flex-row items-center">
                <!-- Image -->
                <img src="{{ asset($item->image_url) }}" alt="{{ $item->name }}"
                    class="w-full md:w-1/2 h-64 object-cover rounded-lg">

                <!-- Details -->
                <div class="mt-6 md:mt-0 md:ml-6">
                    <h1 class="text-2xl font-bold text-slate-900">{{ $item->name }}</h1>
                    <p class="mt-2 text-gray-600">{{ $item->description }}</p>
                    <p class="mt-4 text-xl font-bold text-slate-500">RM{{ $item->price }}</p>

                    <!-- Action Buttons -->
                    <div class="mt-6 flex space-x-4">
                        <form action="{{ route('marketplace.add_to_cart', $item->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-6 py-2 bg-green-500 text-white rounded hover:bg-green-600">Add to Cart</button>
                        </form>
                        
                        <a href="{{ route('marketplace.marketindex') }}"
                            class="px-6 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Back to Catalog</a>
                        <a href="{{ route('marketplace.marketedit', $item->id) }}"
                            class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
