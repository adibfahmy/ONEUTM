<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body class="antialiased">
    <!-- Header and navigation -->
    @include('partials.header')

    <div class="container mx-auto px-4 py-8">
        <!-- Header Row -->
        <div class="flex items-center justify-between mb-6">
            <!-- "Items" Heading -->
            <p class="font-bold text-2xl">Items</p>

            <!-- Search and Add Product -->
            <div class="flex space-x-4">
                <!-- Search Bar -->
                <form action="{{ route('marketplace.marketindex') }}" method="GET" class="flex items-center">
                    <input type="text" name="search" placeholder="Search items..."
                        class="px-4 py-2 border rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ request('search') }}">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-r-md hover:bg-blue-600">
                        Search
                    </button>

                    <!-- Clear Search Button -->
                    @if (request('search'))
                        <a href="{{ route('marketplace.marketindex') }}"
                            class="ml-4 px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                            Clear Search
                        </a>
                    @endif
                </form>

                <!-- Add Product Button -->
                <a href="{{ route('marketplace.marketcreate') }}"
                    class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                    Add a Product
                </a>

                <a href="{{ route('marketplace.cartview') }}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                    Go to Cart
                </a>
            
            </div>
        </div>

        @if ($items->isEmpty())
            <!-- Show Add Product Button if catalog is empty -->
            <div class="text-center py-4">
                <!-- Empty State Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto text-gray-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 10h11m4 0h3m-6 0a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v3a2 2 0 002 2m5 0v10a2 2 0 002 2h4a2 2 0 002-2V10m-6 0H9" />
                </svg>

                <!-- Empty State Text -->
                <p class="font-mono text-2xl text-gray-600 mt-4">Catalog is Empty...</p>
            </div>
        @else
            <!-- Display catalog items if available -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($items as $item)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <!-- Image Section -->
                        <div class="relative w-full h-48">
                            <img src="{{ asset($item->image_url) }}" alt="{{ $item->name }}"
                                class="w-full h-full object-cover">
                        </div>

                        <!-- Details Section -->
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-slate-900">{{ $item->name }}</h3>
                            <p class="text-gray-600">{{ $item->description }}</p>
                            <p class="text-xl font-bold text-slate-500">RM{{ $item->price }}</p>
                            <p class="text-sm font-medium text-slate-700 mt-2">In stock</p>

                            <!-- Action Buttons -->
                            <div class="flex space-x-4 mb-6 text-sm font-medium">
                                <div class="flex-auto flex space-x-4">
                                    {{-- <button class="h-10 px-6 font-semibold rounded-md bg-black text-white" type="button">Buy now</button> --}}
                                    <a href="{{ route('marketplace.marketshow', $item->id) }}"
                                        class="h-10 px-6 font-semibold rounded-md border bg-blue-500 border-slate-200 text-white flex items-center justify-center">
                                        Details
                                    </a>

                                </div>
                                <button
                                    class="flex-none flex items-center justify-center w-9 h-9 rounded-md text-slate-300 border border-slate-200"
                                    type="button" aria-label="Like">
                                    <svg width="20" height="20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Delete Button -->
                            <form action="{{ route('marketplace.destroy', $item->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this item?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="flex items-center justify-center px-4 py-2 font-semibold bg-red-500 text-white rounded hover:bg-red-700 w-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                    Delete
                                </button>
                            </form>

                        </div>
                    </div>
                @endforeach
            </div>

        @endif
    </div>


</body>

</html>
