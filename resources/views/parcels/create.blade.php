<x-app-layout>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-4">Create Pickup Request</h2>

                    <form action="{{ route('parcel.store') }}" method="POST">
                        @csrf
                        @error('name')
                            <span class="text-red-500 ">Name is Required</span>
                        @enderror
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="tracking_number">
                                Tracking Number
                            </label>
                            <input type="text" name="tracking_number" id="tracking_number"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="pickup_point">
                                Pickup Point
                            </label>
                            <select name="pickup_point" id="pickup_point"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required>
                                <option value="" hidden>Select Pickup Point</option>
                                <option value="Cengal Parcel Point">Cengal Parcel Point</option>
                                <option value="One Parcel Centre">One Parcel Centre</option>
                                <option value="Angkasa Ninja Van">Angkasa Ninja Van</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="phone_number">
                                Phone Number
                            </label>
                            <input type="text" name="phone_number" id="phone_number"
                                value="{{ Auth::user()->phone_number }}"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="delivery_address">
                                Delivery Address
                            </label>
                            <textarea name="delivery_address" id="delivery_address" rows="3"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required></textarea>
                        </div>

                        <div class="flex items-center justify-end">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Create Pickup Request
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
