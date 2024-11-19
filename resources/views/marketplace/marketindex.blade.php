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
        <nav class="flex justify-between flex-row p-3  border-b border-gray-300 shadow-sm ">
            <!-- Left Section -->
            <div class="flex items-center">
                <h5 class="text-primary font-bold text-2xl mr-0 lg:mr-32">ONEUTM</h5>
                <div class="text-zinc-500 space-x-4">
                  <a href="/dashboard" class="text-primary">Home</a>
                  <a href="" class="hover:text-primary">More</a>
                  <a href="" class="hover:text-primary">About</a>
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

        <div class="container mx-auto px-4 py-8">
            <!-- Header Row -->
            <div class="flex items-center justify-between mb-6">
                <!-- "Items" Heading -->
                <p class="font-bold text-2xl">Items</p>
        
                <!-- Add Product Button -->
                <a href="{{ route('marketplace.marketcreate') }}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                    Add a Product
                </a>
            </div>
        
            @if($items->isEmpty())
                <!-- Show Add Product Button if catalog is empty -->
                <div class="text-center py-4">
                    <p class="font-bold text-2xl">Catalog is Empty.....</p>
                </div>
            @else
                <!-- Display catalog items if available -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($items as $item)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                            <img src="{{ asset($item->image_url) }}" alt="{{ $item->name }}" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-semibold">{{ $item->name }}</h3>
                                <p class="text-gray-600">{{ $item->description }}</p>
                                <p class="text-xl font-bold">RM{{ $item->price }}</p>
                                <button class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">View Details</button>

                                <form action="{{ route('marketplace.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-700">
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
