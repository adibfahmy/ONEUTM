<?php

namespace App\Http\Controllers;

use App\Mail\ReceiptEmail;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function emailReceipt(Request $request)
{
    $orderId = $request->input('order_id');
    
    // Simulate a recent purchase history (mock data for demo purposes)
    $orderData = [
        'id' => $orderId,
        'product_name' => 'Example Product 1',
        'quantity' => 2,
        'price' => 50.00,
        'total_price' => 100.00,
        'payment_type' => 'Cash',
        'created_at' => now(), // Current date and time for the demo
        'status' => 'Completed',
    ];

    // We can assume that the user email is predefined, since this is just for demo purposes
    $userEmail = 'user@example.com';

    // Send the receipt email with mock data
    Mail::to($userEmail)->send(new ReceiptEmail($orderData));

    return response()->json(['message' => 'Receipt emailed successfully']);
}
}
