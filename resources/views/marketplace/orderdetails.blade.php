<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
    <style>
        body {
            background-color: #f8fafc; /* Light background color */
            font-family: 'Arial', sans-serif; /* Clean font */
        }
        .container {
            max-width: 600px; /* Limit the width of the form */
            margin: auto; /* Center the container */
            padding: 20px; /* Add padding */
            background-color: #ffffff; /* White background for the form */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }
        h1 {
            color: #333; /* Darker text color */
            text-align: center; /* Center the heading */
            margin-bottom: 20px; /* Space below the heading */
        }
        label {
            color: #555; /* Slightly lighter text color for labels */
        }
        input, textarea {
            border: 1px solid #ddd; /* Light border */
            border-radius: 4px; /* Rounded corners */
            padding: 10px; /* Padding inside inputs */
            width: 100%; /* Full width */
            transition: border-color 0.3s; /* Smooth transition for focus */
        }
        input:focus, textarea:focus {
            border-color: #007bff; /* Blue border on focus */
            outline: none; /* Remove default outline */
        }
        button {
            background-color: #007bff; /* Bootstrap primary color */
            color: white; /* White text */
            border: none; /* No border */
            border-radius: 4px; /* Rounded corners */
            padding: 10px 15px; /* Padding for button */
            cursor: pointer; /* Pointer cursor on hover */
            width: 100%; /* Full width */
            transition: background-color 0.3s; /* Smooth transition for hover */
        }
        button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
        .file-upload {
            position: relative; /* Position relative for custom file input */
            overflow: hidden; /* Hide overflow */
        }
        .file-upload input[type="file"] {
            position: absolute; /* Position absolute for file input */
            top: 0;
            right: 0;
            opacity: 0; /* Hide the default file input */
            cursor: pointer; /* Pointer cursor */
        }
        .file-upload-label {
            display: inline-block; /* Inline block for label */
            padding: 10px 15px; /* Padding for label */
            background-color: #e9ecef; /* Light background for label */
            border-radius: 4px; /* Rounded corners */
            cursor: pointer; /* Pointer cursor */
            text-align: center; /* Center text */
            width: 100%; /* Full width */
            transition: background-color 0.3s; /* Smooth transition for hover */
        }
        .file-upload-label:hover {
            background-color: #d6d8db; /* Darker background on hover */
        }
    </style>
</head>
<body class="antialiased">

    @include('partials.header')

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800">Order Details</h1>
        <form action="{{ route('confirmOrder') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="name" class="block font-bold mb-2">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="mb-4">
                <label for="address" class="block font-bold mb-2">Address:</label>
                <textarea id="address" name="address" required></textarea>
            </div>

            <div class="mb-4">
                <label for="phone" class="block font-bold mb-2">Phone Number:</label>
                <input type="text" id="phone" name="phone" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block font-bold mb-2">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <!-- Image Upload Section -->
            <div class="mb-4 file-upload">
                <label for="receipt" class="file-upload-label">Upload Receipt (JPG, PNG, JPEG, GIF):</label>
                <input type="file" id="receipt" name="receipt" accept="image/jpeg, image/png, image/gif" required>
                <h2 class="text-xl font-bold">Bank Account : 1234567891011</h2>
            </div>

            <div class="mt-6">
                <button type="submit">Submit Order</button>
            </div>
        </form>
    </div>

</body>
</html>