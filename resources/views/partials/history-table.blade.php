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
            @foreach ($data as $item)
                <tr>
                    <td class="border px-4 py-2">{{ $item->user->name }}</td>
                    <td class="border px-4 py-2">{{ $item->pickup_address ?? $item->pickup_point }}</td>
                    <td class="border px-4 py-2">{{ $item->phone_number }}</td>
                    <td class="border px-4 py-2">{{ $item->delivery_address }}</td>
                    <td class="border px-4 py-2">
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                            {{ $item->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $item->status === 'picked_up' ? 'bg-blue-100 text-blue-800' : '' }}
                            {{ $item->status === 'out_for_delivery' ? 'bg-purple-100 text-purple-800' : '' }}
                            {{ $item->status === 'delivered' ? 'bg-green-100 text-green-800' : '' }}">
                            {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                        </span>
                    </td>
                    <td class="border px-4 py-2">
                        <a href="{{ route($type . '.track', $item->id) }}" class="text-blue-600 hover:text-blue-900">Track</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
