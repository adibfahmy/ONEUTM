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
       @include('partials.header')

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
