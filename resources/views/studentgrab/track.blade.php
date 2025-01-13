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

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Display validation error message for 'name' -->
                @error('status')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror

                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-4">Track Student Grab Order</h2>

                    <!-- Success Message -->
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4"
                            role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="bg-white p-6 rounded-lg shadow">
                        <!-- Student Grab Order Information -->

                        <div class="flex justify-between">
                            <div class="mb-4">
                                <h3 class="text-lg font-semibold">Order ID</h3>
                                <p class="text-gray-600">{{ $studentGrab->id }}</p>
                            </div>
                            <div class="mb-4 mx-10">
                                <h3 class="text-lg font-semibold">Phone Number</h3>
                                <p class="text-gray-600">{{ $studentGrab->phone_number }}</p>
                            </div>
                            <div class="mb-4">
                                <h3 class="text-lg font-semibold">Pickup Address</h3>
                                <p class="text-gray-600">{{ $studentGrab->pickup_address }}</p>
                            </div>
                            <div class="mb-4 mx-10">
                                <h3 class="text-lg font-semibold">Delivery Address</h3>
                                <p class="text-gray-600">{{ $studentGrab->delivery_address }}</p>
                            </div>

                            <div class="mb-4">
                                <h3 class="text-lg font-semibold">Date</h3>
                                <p class="text-gray-600">
                                    {{ \Carbon\Carbon::parse($studentGrab->date)->format('d M Y') }}</p>
                            </div>
                            <div class="mb-4 mx-10">
                                <h3 class="text-lg font-semibold">Time</h3>
                                <p class="text-gray-600">
                                    {{ \Carbon\Carbon::parse($studentGrab->time)->format('h:i A') }}</p>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h3 class="text-lg font-semibold">Current Status</h3>
                            <p class="text-gray-600">{{ ucfirst(str_replace('_', ' ', $studentGrab->status)) }}</p>
                        </div>

                        <!-- Tracking Progress -->
                        <div class="relative">
                            <div class="flex items-center justify-between mb-8">
                                <div class="w-full flex items-center">
                                    <!-- Pending Step -->
                                    <div class="relative flex flex-col items-center">
                                        <div
                                            class="rounded-full h-12 w-12 flex items-center justify-center bg-green-500">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <div class="text-center mt-2">Pending Pickup</div>
                                    </div>

                                    <!-- Connector -->
                                    <div class="flex-1 h-1 bg-green-300"></div>

                                    <!-- Picked Up Step -->
                                    <div class="relative flex flex-col items-center">
                                        <div
                                            class="rounded-full h-12 w-12 flex items-center justify-center {{ in_array($studentGrab->status, ['picked_up', 'heading_to', 'delivered']) ? 'bg-green-500' : 'bg-gray-300' }}">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3">
                                                </path>
                                            </svg>
                                        </div>
                                        <div class="text-center mt-2">Picked Up</div>
                                    </div>

                                    <!-- Connector -->
                                    <div
                                        class="flex-1 h-1 {{ in_array($studentGrab->status, ['heading_to', 'delivered']) ? 'bg-green-300' : 'bg-gray-300' }}">
                                    </div>

                                    <!-- Out for Delivery Step -->
                                    <div class="relative flex flex-col items-center">
                                        <div
                                            class="rounded-full h-12 w-12 flex items-center justify-center {{ in_array($studentGrab->status, ['heading_to', 'delivered']) ? 'bg-green-500' : 'bg-gray-300' }}">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 0c-2.8 0-5 2.2-5 5v3h10v-3c0-2.8-2.2-5-5-5z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div class="text-center mt-2">Heading to</div>
                                    </div>

                                    <!-- Connector -->
                                    <div
                                        class="flex-1 h-1 {{ $studentGrab->status == 'delivered' ? 'bg-green-300' : 'bg-gray-300' }}">
                                    </div>

                                    <!-- Delivered Step -->
                                    <div class="relative flex flex-col items-center">
                                        <div
                                            class="rounded-full h-12 w-12 flex items-center justify-center {{ $studentGrab->status == 'delivered' ? 'bg-green-500' : 'bg-gray-300' }}">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4"></path>
                                            </svg>
                                        </div>
                                        <div class="text-center mt-2">Delivered</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons Based on Status -->
                        @if ($studentGrab->status === 'pending')
                            <form action="{{ route('studentgrab.pickup', $studentGrab->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Pick Up
                                </button>
                            </form>
                        @elseif ($studentGrab->status === 'picked_up')
                            <div class="flex items-center justify-between">
                                <form action="{{ route('studentgrab.updateStatus', $studentGrab->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    <input type="hidden" name="status" value="heading_to">
                                    <button type="submit"
                                        class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                        Heading to
                                    </button>
                                </form>

                                <!-- Cancel Order Button (only for deliverer) -->
                                @if ($studentGrab->deliverer_id === Auth::id())
                                    <form action="{{ route('studentgrab.cancelOrder', $studentGrab->id) }}"
                                        method="POST" class="inline ml-auto">
                                        @csrf
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                            Cancel Order
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @elseif ($studentGrab->status === 'heading_to')
                            <form action="{{ route('studentgrab.updateStatus', $studentGrab->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="delivered">
                                <button type="submit"
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Mark as Delivered
                                </button>
                            </form>
                        @endif

                        <!-- Show Delete Button if Delivered -->
                        @if ($studentGrab->status === 'delivered')
                            <form action="{{ route('studentgrab.destroy', $studentGrab->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this order?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-4">
                                    Delete Order
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
