<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')

    <script>
        function printReceipt(orderId) {
            const orderContent = document.getElementById('order-' + orderId).innerHTML;
            const printWindow = window.open('', '_blank', 'width=800,height=600');
            printWindow.document.write('<html><head><title>Receipt</title><style>body { font-family: Arial, sans-serif; padding: 20px; } .receipt { margin-top: 20px; border: 1px solid #ddd; padding: 20px; border-radius: 8px; } .header { text-align: center; font-size: 24px; font-weight: bold; margin-bottom: 20px; } .details { margin-bottom: 15px; font-size: 16px; } .footer { text-align: center; margin-top: 30px; font-size: 14px; }</style></head><body>');
            printWindow.document.write(orderContent);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }

        function emailReceipt(orderId) {
            // Here you can replace the action to send an email. For now, it's a simple alert.
            alert("Email sent for Order #" + orderId); 
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js">
    function emailReceipt(orderId) {
    axios.post('/email-receipt/' + orderId)
        .then(function (response) {
            alert(response.data.message); // Show success message
        })
        .catch(function (error) {
            alert('There was an error sending the receipt.');
        });
}

    </script>


    <style>
        .order-container {
            display: flex;
            justify-content: space-between;
            padding-bottom: 20px;
            position: relative;
            align-items: flex-start;
            margin-bottom: 20px;
            border-bottom: 2px solid #f0f0f0;
        }

        .order-details {
            flex: 1;
            padding-right: 20px;
        }

        .product-image {
            max-width: 120px;
            max-height: 120px;
            object-fit: cover;
            margin-left: 20px;
            border-radius: 8px;
        }

        .price-total {
            text-align: right;
            font-size: 16px;
            font-weight: bold;
            padding-left: 20px;
        }

        .receipt {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            background-color: #fafafa;
        }

        .header {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .details {
            font-size: 16px;
            margin-bottom: 15px;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
        }

        .footer button {
            padding: 10px 20px;
            background-color: #ec1212;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin: 5px;
        }

        .footer button:hover {
            background-color: #d80e0e;
        }

        .order-container p {
            margin: 5px 0;
        }
    </style>
</head>

<body class="antialiased">
    <!-- Header and navigation -->
    @include('partials.header')

    <div class="container mx-auto px-4 py-8">
        <p class="font-mono text-2xl font-bold mb-6">Purchase History</p>

        <!-- Static Purchase History Example -->
        @foreach ($orders as $order)
        <div class="bg-white p-6 rounded shadow-lg" id="order-{{ $order->id }}">
            <div class="receipt">
                <div class="header">
                    <p>Receipt for Order #{{ $order->id }}</p>
                </div>
                <div class="order-container">
                    <div class="order-details">
                        <div class="details">
                            <p><strong>Name:</strong> {{ $order->name }}</p>
                            <p><strong>Address:</strong> {{ $order->address }}</p>
                            <p><strong>Phone:</strong> {{ $order->phone }}</p>
                            <p><strong>Email:</strong> {{ $order->email }}</p>
                            <p><strong>Status:</strong> {{ $order->status }}</p>
                        </div>
                    </div>
                    <img src="{{ asset('storage/' . $order->receipt) }}" alt="Receipt Image" class="product-image">
                </div>
                <div class="footer">
                    <button onclick="printReceipt({{ $order->id }})">
                        Print Receipt
                    </button>
                    <button onclick="emailReceipt({{ $order->id }})">
                        Email Receipt
                    </button>
                </div>
            </div>
        </div>
        @endforeach      
          
    </div>

</body>

</html>
