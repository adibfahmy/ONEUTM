<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body class="antialiased">
    <!-- Header and navigation -->
    @include('partials.header')

    <div class="container mx-auto px-4 py-8">
        <p class="font-mono text-2xl font-bold mb-6">Update Product</p>

        <!-- Product Update Form -->
        <form action="{{ route('marketplace.marketupdate', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ $item->name }}" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700">Description</label>
                <textarea name="description" id="description" class="w-full p-2 border border-gray-300 rounded" required>{{ $item->description }}</textarea>
            </div>

            <div class="mb-4">
                <label for="image" class="block text-gray-700">Upload Image</label>
                <input type="file" name="image" id="image" class="w-full p-2 border border-gray-300 rounded" accept="image/*">
            </div>

            <div class="mb-4">
                <label for="price" class="block text-gray-700">Price</label>
                <input type="number" name="price" id="price" value="{{ $item->price }}" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <button type="submit" class="px-6 py-3 bg-green-500 text-white rounded hover:bg-green-600">Update Product</button>
        </form>
    </div>

</body>

</html>