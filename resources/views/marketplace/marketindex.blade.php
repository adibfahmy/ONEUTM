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
                        <!-- Image Section -->
                        <div class="relative w-full h-48">
                            <img src="{{ asset($item->image_url) }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
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
                                    <button class="h-10 px-6 font-semibold rounded-md bg-black text-white" type="button">Buy now</button>
                                    <button class="h-10 px-6 font-semibold rounded-md border border-slate-200 text-slate-900" type="button">Details</button>
                                </div>
                                <button class="flex-none flex items-center justify-center w-9 h-9 rounded-md text-slate-300 border border-slate-200" type="button" aria-label="Like">
                                    <svg width="20" height="20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" />
                                    </svg>
                                </button>
                            </div>
                
                            <!-- Delete Button -->
                            <form action="{{ route('marketplace.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-700 w-full">
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
