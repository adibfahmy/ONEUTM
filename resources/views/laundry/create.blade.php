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
                    <h2 class="text-2xl font-bold mb-4">Create Laundry Pickup Request</h2>

                    <form action="{{ route('laundry.store') }}" method="POST">
                        @csrf

                        <!-- Pickup Address -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="pickup_address">
                                Pickup Address
                            </label>
                            <input type="text" name="pickup_address" id="pickup_address"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required placeholder="Enter pickup address">
                        </div>

                        <!-- Phone Number -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="phone_number">
                                Phone Number
                            </label>
                            <input type="text" name="phone_number" id="phone_number"
                                value="{{ Auth::user()->phone_number }}"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required>
                        </div>

                        <!-- Delivery Address -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="delivery_address">
                                Delivery Address
                            </label>
                            <textarea name="delivery_address" id="delivery_address" rows="3"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required placeholder="Enter delivery address"></textarea>
                        </div>

                        <!-- Use Same Address Checkbox -->
                        <div class="mb-4">
                            <label class="inline-flex items-center">
                                <input type="checkbox" id="use_same_address" class="form-checkbox">
                                <span class="ml-2">Use the same address for Pickup</span>
                            </label>
                        </div>

                        <!-- JavaScript to auto-fill Pickup Address if the checkbox is checked -->
                        <script>
                            document.getElementById('use_same_address').addEventListener('change', function() {
                                if (this.checked) {
                                    document.getElementById('pickup_address').value = document.getElementById('delivery_address').value;
                                } else {
                                    document.getElementById('pickup_address').value = '';
                                }
                            });
                        </script>

                        <div class="flex items-center justify-end mt-6">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Create Laundry Pickup Request
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
