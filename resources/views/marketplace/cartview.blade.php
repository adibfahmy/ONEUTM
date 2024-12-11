<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
</head>
<body class="antialiased">

    @include('partials.header')

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800">Shopping Cart</h1>

        @if(count($cart) > 0)
            <div class="mt-6 bg-white p-6 rounded-lg shadow-lg">
                <table class="w-full table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">Product</th>
                            <th class="px-4 py-2 text-left">Price</th>
                            <th class="px-4 py-2 text-left">Quantity</th>
                            <th class="px-4 py-2 text-left">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $id => $item)
                            <tr>
                                <td class="px-4 py-2">{{ $item['name'] }}</td>
                                <td class="px-4 py-2">RM{{ number_format($item['price'], 2) }}</td>
                                <td class="px-4 py-2">{{ $item['quantity'] }}</td>
                                <td class="px-4 py-2">RM{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    <h2 class="text-xl font-bold">Total: RM{{ number_format(array_sum(array_column($cart, 'price')), 2) }}</h2>
                </div>

                <div class="mt-6 flex space-x-4">
                    <a href="{{ route('marketplace.marketindex') }}" class="px-6 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Continue Shopping</a>
                    <a href="{{ route('checkout') }}" class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Proceed to Checkout</a>
                </div>
            </div>
        @else
            <p>Your cart is empty.</p>
        @endif
    </div>

</body>
</html>
