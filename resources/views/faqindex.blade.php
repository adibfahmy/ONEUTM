<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
    <style>
        body {
            background-color: #f8fafc; /* Light background color */
            font-family: 'Arial', sans-serif; /* Clean font */
            margin: 0; /* Remove default margin */
            padding: 20px; /* Add padding to the body */
        }

        .container {
            max-width: 800px; /* Limit the width of the container */
            margin: auto; /* Center the container */
            padding: 20px; /* Add padding */
            background-color: #ffffff; /* White background for the container */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }

        h1 {
            text-align: center; /* Center the heading */
            color: #333; /* Darker text color */
            margin-bottom: 20px; /* Space below the heading */
        }

        .faq-item {
            background-color: #f1f5f9; /* Light gray background for FAQ items */
            border-radius: 8px; /* Rounded corners */
            padding: 15px; /* Padding inside FAQ items */
            margin-bottom: 15px; /* Space between FAQ items */
            transition: box-shadow 0.3s; /* Smooth transition for shadow */
        }

        .faq-item:hover {
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.2); /* Shadow on hover */
        }

        .faq-item h3 {
            color: #2d3748; /* Darker color for questions */
            margin: 0; /* Remove default margin */
            font-size: 1.25rem; /* Font size for questions */
        }

        .faq-item p {
            color: #4a5568; /* Slightly lighter color for answers */
            margin-top: 5px; /* Space above the answer */
            line-height: 1.5; /* Line height for better readability */
        }
    </style>
</head>

<body class="antialiased">
    <!-- Header and navigation -->
    @include('partials.header')

    <div class="container">
        <h1>Frequently Asked Questions</h1>

        @foreach($faqs as $faq)
        <div class="faq-item">
            <h3>{{ $faq->question }}</h3>
            <p>{{ $faq->answer }}</p>
        </div>
        @endforeach
    </div>
</body>

</html>