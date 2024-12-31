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
                    <h2 class="text-2xl font-bold mb-4">Admin Dashboard History</h2>

                    <div>
                        <ul class="flex mb-4 space-x-4">
                            <li><a href="#laundry" class="text-blue-500 hover:underline">Laundry</a></li>
                            <li><a href="#parcel" class="text-blue-500 hover:underline">Parcel</a></li>
                            <li><a href="#marketplace" class="text-blue-500 hover:underline">Marketplace</a></li>
                            <li><a href="#student-grab" class="text-blue-500 hover:underline">Student Grab</a></li>
                        </ul>
                    </div>

                    <div id="laundry" class="mb-8">
                        <h3 class="text-xl font-bold">Laundry History</h3>
                        @include('partials.history-table', ['data' => $laundries, 'type' => 'laundry'])
                    </div>

                    <div id="parcel" class="mb-8">
                        <h3 class="text-xl font-bold">Parcel History</h3>
                        @include('partials.history-table', ['data' => $parcels, 'type' => 'parcel'])
                    </div>

                    {{-- <div id="marketplace" class="mb-8">
                        <h3 class="text-xl font-bold">Marketplace Orders</h3>
                        @include('partials.history-table', ['data' => $marketplaceOrders, 'type' => 'marketplace'])
                    </div>

                    <div id="student-grab" class="mb-8">
                        <h3 class="text-xl font-bold">Student Grab</h3>
                        @include('partials.history-table', ['data' => $studentGrabs, 'type' => 'student-grab'])
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</body>

</html>
