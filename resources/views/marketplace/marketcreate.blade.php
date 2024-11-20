<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Add Product</title>
        @vite('resources/css/app.css')
    </head>
    <body class="antialiased">
        <!-- Header and navigation -->
        <nav class="flex justify-between flex-row p-3  border-b border-gray-300 shadow-sm ">
            <!-- Left Section -->
            <div class="flex items-center">
                <h5 class="text-primary font-bold text-2xl mr-0 lg:mr-32">ONEUTM</h5>
                <div class="text-zinc-500 space-x-4">
                  <a href="" class="text-primary">Home</a>
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
              <span class="mx-1 text-md">Profile</span>
            </div>
        </nav>

        <div class="container mx-auto px-4 py-8">
            <p class="font-mono text-2xl font-bold mb-6">Add Product</p>

            <!-- Product Add Form -->
            <form action="{{ route('marketplace.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Name</label>
                    <input type="text" name="name" id="name" class="w-full p-2 border border-gray-300 rounded" required>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-gray-700">Description</label>
                    <textarea name="description" id="description" class="w-full p-2 border border-gray-300 rounded" required></textarea>
                </div>

                <div class="mb-4">
                    <label for="image" class="block text-gray-700">Upload Image</label>
                    <input type="file" name="image" id="image" class="w-full p-2 border border-gray-300 rounded" accept="image/*" required>
                </div>

                <div class="mb-4">
                    <label for="price" class="block text-gray-700">Price</label>
                    <input type="number" name="price" id="price" class="w-full p-2 border border-gray-300 rounded" required>
                </div>

                <button type="submit" class="px-6 py-3 bg-green-500 text-white rounded hover:bg-green-600">Add Product</button>
            </form>
        </div>

    </body>
</html>