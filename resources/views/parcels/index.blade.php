{{-- resources/views/parcels/index.blade.php --}}
{{-- <x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-bold">Available Parcels Services</h2>
                        <a href="{{ route('parcels.create') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Create Pickup
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2">Name</th>
                                    <th class="px-4 py-2">Pickup Point</th>
                                    <th class="px-4 py-2">Phone Number</th>
                                    <th class="px-4 py-2">Delivery Address</th>
                                    <th class="px-4 py-2">Status</th>
                                    <th class="px-4 py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($parcels as $parcel)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $parcel->user->name }}</td>
                                        <td class="border px-4 py-2">{{ $parcel->pickup_point }}</td>
                                        <td class="border px-4 py-2">{{ $parcel->phone_number }}</td>
                                        <td class="border px-4 py-2">{{ $parcel->delivery_address }}</td>
                                        <td class="border px-4 py-2">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $parcel->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                {{ $parcel->status === 'picked_up' ? 'bg-blue-100 text-blue-800' : '' }}
                                                {{ $parcel->status === 'out_for_delivery' ? 'bg-purple-100 text-purple-800' : '' }}
                                                {{ $parcel->status === 'delivered' ? 'bg-green-100 text-green-800' : '' }}">
                                                {{ ucfirst(str_replace('_', ' ', $parcel->status)) }}
                                            </span>
                                        </td>
                                        <td class="border px-4 py-2">
                                            <a href="{{ route('parcel.track', $parcel) }}"
                                                class="text-blue-600 hover:text-blue-900">Track</a>

                                            @php
                                                $route = '';
                                                $buttonText = '';
                                                $buttonClass = '';
                                                $statusValue = '';

                                                switch ($parcel->status) {
                                                    case 'pending':
                                                        $route = route('parcel.pickup', $parcel->id);
                                                        $buttonText = 'Pick Up';
                                                        $buttonClass = 'text-blue-600 hover:text-blue-900';
                                                        break;

                                                    case 'picked_up':
                                                        $route = route('parcel.updateStatus', $parcel->id);
                                                        $buttonText = 'Out for Delivery';
                                                        $buttonClass = 'text-purple-600 hover:text-purple-900';
                                                        $statusValue = 'out_for_delivery';
                                                        break;

                                                    case 'out_for_delivery':
                                                        $route = route('parcel.updateStatus', $parcel->id);
                                                        $buttonText = 'Mark as Delivered';
                                                        $buttonClass = 'text-green-600 hover:text-green-900';
                                                        $statusValue = 'delivered';
                                                        break;
                                                }
                                            @endphp

                                            @if ($route)
                                                <form action="{{ $route }}" method="POST" class="inline">
                                                    @csrf
                                                    @if ($statusValue)
                                                        <input type="hidden" name="status"
                                                            value="{{ $statusValue }}">
                                                    @endif
                                                    <button type="submit" class="ml-2 {{ $buttonClass }}">
                                                        {{ $buttonText }}
                                                    </button>
                                                </form>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $parcels->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}


{{-- <x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-bold">Available Parcels Services</h2>
                        <a href="{{ route('parcels.create') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Create Pickup
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2">Name</th>
                                    <th class="px-4 py-2">Pickup Point</th>
                                    <th class="px-4 py-2">Phone Number</th>
                                    <th class="px-4 py-2">Delivery Address</th>
                                    <th class="px-4 py-2">Status</th>
                                    <th class="px-4 py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($parcels as $parcel)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $parcel->user->name }}</td>
                                        <td class="border px-4 py-2">{{ $parcel->pickup_point }}</td>
                                        <td class="border px-4 py-2">{{ $parcel->phone_number }}</td>
                                        <td class="border px-4 py-2">{{ $parcel->delivery_address }}</td>
                                        <td class="border px-4 py-2">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $parcel->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                {{ $parcel->status === 'picked_up' ? 'bg-blue-100 text-blue-800' : '' }}
                                                {{ $parcel->status === 'out_for_delivery' ? 'bg-purple-100 text-purple-800' : '' }}
                                                {{ $parcel->status === 'delivered' ? 'bg-green-100 text-green-800' : '' }}">
                                                {{ ucfirst(str_replace('_', ' ', $parcel->status)) }}
                                            </span>
                                            <td class="border px-4 py-2">
                                                @if ($parcel->status === 'pending')
                                                    <form action="{{ route('parcel.acceptOrder', $parcel->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="text-blue-600 hover:text-blue-900">
                                                            Accept Order
                                                        </button>
                                                    </form>
                                                @else
                                                    <a href="{{ route('parcel.track', $parcel) }}" class="text-blue-600 hover:text-blue-900">View Status</a>
                                                @endif


                                                @if ($parcel->deliverer_id === Auth::id() && $parcel->status === 'picked_up')
                                                    <form action="{{ route('parcel.cancelOrder', $parcel->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="text-red-600 hover:text-red-900">Cancel Order</button>
                                                    </form>
                                                @endif
                                            </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $parcels->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}

{{-- resources/views/parcels/index.blade.php --}}

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-bold">Available Parcels Services</h2>
                        <a href="{{ route('parcels.create') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Create Pickup
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2">Name</th>
                                    <th class="px-4 py-2">Pickup Point</th>
                                    <th class="px-4 py-2">Phone Number</th>
                                    <th class="px-4 py-2">Delivery Address</th>
                                    <th class="px-4 py-2">Status</th>
                                    <th class="px-4 py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($parcels as $parcel)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $parcel->user->name }}</td>
                                        <td class="border px-4 py-2">{{ $parcel->pickup_point }}</td>
                                        <td class="border px-4 py-2">{{ $parcel->phone_number }}</td>
                                        <td class="border px-4 py-2">{{ $parcel->delivery_address }}</td>
                                        <td class="border px-4 py-2">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $parcel->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                {{ $parcel->status === 'picked_up' ? 'bg-blue-100 text-blue-800' : '' }}
                                                {{ $parcel->status === 'out_for_delivery' ? 'bg-purple-100 text-purple-800' : '' }}
                                                {{ $parcel->status === 'delivered' ? 'bg-green-100 text-green-800' : '' }}">
                                                {{ ucfirst(str_replace('_', ' ', $parcel->status)) }}
                                            </span>
                                        </td>
                                        <td class="border px-4 py-2">
                                            @if ($parcel->status === 'pending')
                                                <a href="{{ route('parcel.track', $parcel->id) }}" class="text-blue-600 hover:text-blue-900">Accept Order</a>
                                            @else
                                                <a href="{{ route('parcel.track', $parcel->id) }}" class="text-blue-600 hover:text-blue-900">Track</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $parcels->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


