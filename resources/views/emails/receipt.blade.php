<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .receipt {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .header {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }
        .details {
            margin-bottom: 15px;
            font-size: 16px;
        }
    </style>
</head>
<body>

    <div class="receipt">
        <div class="header">
            <p>Receipt for Order #{{ $order['id'] }}</p>
        </div>

        <div class="details">
            <p><strong>Product Name:</strong> {{ $order['product_name'] }}</p>
            <p><strong>Quantity:</strong> {{ $order['quantity'] }}</p>
            <p><strong>Price:</strong> RM{{ number_format($order['price'], 2) }}</p>
            <p><strong>Total:</strong> RM{{ number_format($order['total_price'], 2) }}</p>
            <p><strong>Payment Type:</strong> {{ $order['payment_type'] }}</p>
            <p><strong>Date of Purchase:</strong> {{ $order['created_at']->format('Y-m-d') }}</p>
            <p><strong>Time of Purchase:</strong> {{ $order['created_at']->format('H:i') }}</p>
            <p><strong>Order Status:</strong> {{ $order['status'] }}</p>
        </div>

        <p>Thank you for your purchase!</p>
    </div>

</body>
</html>
