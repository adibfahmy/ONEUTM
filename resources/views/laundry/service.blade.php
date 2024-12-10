{{-- resources/views/laundry/serviceLaundry.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
</head>

<body class="bg-tertiary text-gray-900">

    <header class="bg-white">
        @include('partials.header')
    </header>

    <div class="container mx-auto px-4 py-6">
        <!-- Welcome Message -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <h1 class="text-2xl font-bold mb-2">Welcome to LaundryPro!</h1>
            <p class="text-gray-600">Get your laundry picked up, cleaned, and delivered back to your doorstep with ease.
                Experience hassle-free laundry service today.</p>
        </div>

        <!-- Quick Actions Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <!-- Create Laundry Request Card -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold">Create Laundry Request</h2>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <p class="text-gray-600 mb-4">Schedule a new laundry pickup quickly and conveniently.</p>
                <a href="{{ route('laundry.create') }}"
                    class="inline-block w-full bg-blue-500 text-white text-center py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200">
                    Create Laundry Request
                </a>
            </div>

            <!-- Track Laundry Request Card -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold">Track Laundry</h2>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                </div>
                <p class="text-gray-600 mb-4">Track the status of your ongoing laundry requests.</p>
                <a href="{{ route('laundry.index') }}"
                    class="inline-block w-full bg-green-500 text-white text-center py-2 px-4 rounded-lg hover:bg-green-600 transition duration-200">
                    View All Requests
                </a>
            </div>

            <!-- My Laundry Requests Card -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold">My Laundry Requests</h2>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7v10c0 1.104.896 2 2 2h14c1.104 0 2-.896 2-2V7c0-1.104-.896-2-2-2H5c-1.104 0-2 .896-2 2zm3 1h4v2H6V8zm0 4h4v2H6v-2zm6-4h4v6h-4V8z" />
                    </svg>
                </div>
                <p class="text-gray-600 mb-4">View and manage all your personal laundry requests.</p>
                <a href="{{ route('laundry.myLaundry') }}"
                    class="inline-block w-full bg-indigo-500 text-white text-center py-2 px-4 rounded-lg hover:bg-indigo-600 transition duration-200">
                    My Requests
                </a>
            </div>

            <!-- Quick Stats Card -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold">Quick Stats</h2>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 a2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Pending Requests</span>
                        <span class="font-semibold">{{ $pendingCount ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">In Process</span>
                        <span class="font-semibold">{{ $inProcessCount ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Completed Today</span>
                        <span class="font-semibold">{{ $completedToday ?? 0 }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
