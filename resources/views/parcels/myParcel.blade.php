<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
</head>

<body class="bg-tertiary text-gray-900">
    <header class="bg-white">
        @include('partials.header')
    </header>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg border border-gray-300">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-4">My Parcel Requests</h2>

                    @if ($userParcels->isEmpty())
                        <p class="text-gray-600">You have no parcel requests at the moment.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white">
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 border-b">Tracking Number</th>
                                        <th class="py-2 px-4 border-b">Pickup Point</th>
                                        <th class="py-2 px-4 border-b">Phone Number</th>
                                        <th class="py-2 px-4 border-b">Delivery Address</th>
                                        <th class="py-2 px-4 border-b">Deliverer Phone Number</th>
                                        <th class="py-2 px-4 border-b">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($userParcels as $parcel)
                                        <tr>
                                            <td class="py-2 px-4 border-b">{{ $parcel->tracking_number }}</td>
                                            <td class="py-2 px-4 border-b">{{ $parcel->pickup_point }}</td>
                                            <td class="py-2 px-4 border-b">{{ $parcel->phone_number }}</td>
                                            <td class="py-2 px-4 border-b">{{ $parcel->delivery_address }}</td>
                                            <td class="py-2 px-4 border-b">
                                                @if ($parcel->status != 'pending')
                                                    {{ $parcel->deliverer ? $parcel->deliverer->phone_number : 'No deliverer assigned' }}
                                                @else
                                                    No deliverer assigned
                                                @endif
                                            </td>
                                            <td class="py-2 px-4 border-b">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    {{ $parcel->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                    {{ $parcel->status === 'picked_up' ? 'bg-blue-100 text-blue-800' : '' }}
                                                    {{ $parcel->status === 'out_for_delivery' ? 'bg-purple-100 text-purple-800' : '' }}
                                                    {{ $parcel->status === 'delivered' ? 'bg-green-100 text-green-800' : '' }}">
                                                    {{ ucfirst(str_replace('_', ' ', $parcel->status)) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>

</html>
