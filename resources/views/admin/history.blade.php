<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
</head>

<body>
    @include('partials.admin-header')

    <main class="container mx-auto px-12 py-8">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <h2 class="text-2xl font-bold mb-4">Admin Dashboard History</h2>

            <!-- Tab Navigation -->
            <div>
                <ul class="flex mb-4 space-x-4 border-b">
                    <li>
                        <button class="tab-button text-blue-500 font-bold py-2 px-4 hover:underline active-tab"
                            data-tab="laundry">Laundry</button>
                    </li>
                    <li>
                        <button class="tab-button text-blue-500 font-bold py-2 px-4 hover:underline"
                            data-tab="parcel">Parcel</button>
                    </li>
                    <li>
                        <button class="tab-button text-blue-500 font-bold py-2 px-4 hover:underline"
                            data-tab="student-grab">Student Grab</button>
                    </li>
                </ul>
            </div>

            <!-- Tab Content -->
            <div id="laundry" class="tab-content">
                <h3 class="text-xl font-bold">Laundry History</h3>
                @include('partials.history-table', ['data' => $laundries, 'type' => 'laundry'])
            </div>

            <div id="parcel" class="tab-content hidden">
                <h3 class="text-xl font-bold">Parcel History</h3>
                @include('partials.history-table', ['data' => $parcels, 'type' => 'parcel'])
            </div>


            <div id="student-grab" class="tab-content hidden">
                <h3 class="text-xl font-bold">Student Grab History</h3>
                @include('partials.history-table', ['data' => $StudentGrab, 'type' => 'student-grab'])
            </div>
        </div>
    </main>

    <script>
        // JavaScript for Tab Switching
        document.addEventListener("DOMContentLoaded", function() {
            const tabs = document.querySelectorAll(".tab-button");
            const contents = document.querySelectorAll(".tab-content");

            tabs.forEach(tab => {
                tab.addEventListener("click", () => {
                    // Remove active class from all tabs and hide all content
                    tabs.forEach(t => t.classList.remove("active-tab"));
                    contents.forEach(c => c.classList.add("hidden"));

                    // Add active class to clicked tab and show corresponding content
                    tab.classList.add("active-tab");
                    const contentId = tab.getAttribute("data-tab");
                    document.getElementById(contentId).classList.remove("hidden");
                });
            });
        });
    </script>


    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl p-6 w-96"
            style="transform: translate(-50%, -50%); position: absolute; top: 50%; left: 50%;">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Confirm Deletion</h3>
            <p class="text-gray-600 mb-6">Are you sure you want to delete this user?</p>
            <div class="flex justify-end space-x-3">
                <button onclick="closeDeleteModal()"
                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">
                    Cancel
                </button>
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>


    <script>
        // Open the delete modal and set the action
        function openDeleteModal(actionUrl) {
            const deleteModal = document.getElementById('deleteModal');
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.action = actionUrl; // Set the action dynamically
            deleteModal.classList.remove('hidden');
        }

        // Close the delete modal
        function closeDeleteModal() {
            const deleteModal = document.getElementById('deleteModal');
            deleteModal.classList.add('hidden');
        }
    </script>

</body>

</html>
