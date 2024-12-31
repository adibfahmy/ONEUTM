<div class="overflow-x-auto">
    <table class="min-w-full table-auto">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Pickup Point</th>
                <th class="px-4 py-2">Phone Number</th>
                <th class="px-4 py-2">Delivery Address</th>

                @if ($type === 'student-grab')
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">Time</th>
                @endif

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

                    @if ($type === 'student-grab')
                        <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($item->date)->format('Y-m-d') }}</td>
                        <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($item->time)->format('H:i A') }}</td>
                    @endif


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
                        <!-- Trigger Button -->
                        <a href="javascript:void(0);"
                            onclick="openDeleteModal('{{ route('admin.history.delete', ['type' => $type, 'id' => $item->id]) }}')"
                            class="text-red-600 hover:text-red-900">
                            Delete
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
