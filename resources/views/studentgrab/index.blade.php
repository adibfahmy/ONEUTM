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
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-bold">Available Student Grab Services</h2>
                        <a href="{{ route('studentgrab.create') }}"
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
                                    <th class="px-4 py-2">Date</th>
                                    <th class="px-4 py-2">Time</th>
                                    <th class="px-4 py-2">Status</th>
                                    <th class="px-4 py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($studentGrabs as $studentgrab)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $studentgrab->user->name }}</td>
                                        <td class="border px-4 py-2">{{ $studentgrab->pickup_address }}</td>
                                        <td class="border px-4 py-2">{{ $studentgrab->phone_number }}</td>
                                        <td class="border px-4 py-2">{{ $studentgrab->delivery_address }}</td>
                                        <td class="border px-4 py-2">
                                            {{ \Carbon\Carbon::parse($studentgrab->date)->format('M d, Y') }}</td>
                                        <td class="border px-4 py-2">
                                            {{ \Carbon\Carbon::parse($studentgrab->time)->format('H:i A') }}</td>
                                        <td class="border px-4 py-2">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $studentgrab->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                {{ $studentgrab->status === 'picked_up' ? 'bg-blue-100 text-blue-800' : '' }}
                                                {{ $studentgrab->status === 'heading_to' ? 'bg-purple-100 text-purple-800' : '' }}
                                                {{ $studentgrab->status === 'delivered' ? 'bg-green-100 text-green-800' : '' }}">
                                                {{ ucfirst(str_replace('_', ' ', $studentgrab->status)) }}
                                            </span>
                                        </td>
                                        <td class="border px-4 py-2">
                                            @if ($studentgrab->status === 'pending')
                                                <a href="{{ route('studentgrab.track', $studentgrab->id) }}"
                                                    class="text-blue-600 hover:text-blue-900">Accept Order</a>
                                            @else
                                                <a href="{{ route('studentgrab.track', $studentgrab->id) }}"
                                                    class="text-blue-600 hover:text-blue-900">Track</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $studentGrabs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
