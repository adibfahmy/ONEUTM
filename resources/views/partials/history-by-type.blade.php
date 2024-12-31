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
                    <h2 class="text-2xl font-bold">{{ ucfirst($type) }} History</h2>
                </div>

                @include('partials.history-table', ['data' => $data, 'type' => $type])

                <div class="mt-4">
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
