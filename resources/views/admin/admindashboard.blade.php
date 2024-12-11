<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body>
    @include('partials.admin-header')

    <div class="relative">
        <div id="success-alert"
            class="fixed top-4 right-4 z-50 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded "
            role="alert" style="display: none;">
            <strong class="font-bold mr-2">Success!</strong>
            <span class="block sm:inline" id="success-message"></span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg onclick="closeSuccessAlert()" class="fill-current h-6 w-6 text-green-500 cursor-pointer"
                    role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <title>Close</title>
                    <path
                        d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.03a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                </svg>
            </span>
        </div>

    </div>
    <main class="container mx-auto px-4 py-8">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">User Management</h2>
            </div>


            <table class="w-full">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Phone Number
                        </th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->phone_number }}</td>
                            <td class="px-6 py-4 whitespace-nowrap flex space-x-2">
                                <a href="{{ route('admin.users.edit', $user) }}"
                                    class="text-blue-600 hover:text-blue-900 font-medium">
                                    Edit
                                </a>
                                <button onclick="openDeleteModal({{ $user->id }})"
                                    class="text-red-600 hover:text-red-900 font-medium">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                {{ $users->links() }}
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-xl p-6 w-96">
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
    </main>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showSuccessAlert('{{ session('success') }}');
            });
        </script>
    @endif

    <script>
        function openDeleteModal(userId) {
            const modal = document.getElementById('deleteModal');
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.action = `/admin/users/${userId}`;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }

        function showSuccessAlert(message) {
            const alertElement = document.getElementById('success-alert');
            const messageElement = document.getElementById('success-message');

            messageElement.textContent = message;
            alertElement.style.display = 'block';

            // Automatically hide after 5 seconds
            setTimeout(() => {
                closeSuccessAlert();
            }, 5000);
        }

        function closeSuccessAlert() {
            const alertElement = document.getElementById('success-alert');
            alertElement.style.display = 'none';
        }
    </script>


</body>

</html>
