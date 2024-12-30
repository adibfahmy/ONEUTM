<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
</head>
<body class="antialiased">

    @include('partials.header')

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800">Order Details</h1>
        <div class="mt-6 bg-white p-6 rounded-lg shadow-lg">
            <form action="{{ route('confirmOrder') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">Name:</label>
                    <input type="text" id="name" name="name" class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
                </div>

                <div class="mb-4">
                    <label for="address" class="block text-gray-700 font-bold mb-2">Address:</label>
                    <textarea id="address" name="address" class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring focus:border-blue-300" required></textarea>
                </div>

                <div class="mb-4">
                    <label for="phone" class="block text-gray-700 font-bold mb-2">Phone Number:</label>
                    <input type="text" id="phone" name="phone" class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
                    <input type="email" id="email" name="email" class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
                </div>

                <div class="mt-6">
                    <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Submit Order</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
