<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class BillController extends Controller
{
    public function getBill($orderId)
    {
        $order = Order::with('items.product')->find($orderId);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $billDetails = [];
        foreach ($order->items as $item) {
            $billDetails[] = [
                'product' => $item->product->name,
                'variant' => $item->variant,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'total' => $item->price * $item->quantity
            ];
        }

        return response()->json([
            'table_no' => $order->table_no,
            'total_price' => $order->total_price,
            'bill_details' => $billDetails
        ]);
    }

    public function showBill($orderId)
    {
        $order = Order::with('items.product')->find($orderId);

        if (!$order) {
            return redirect('/')->with('error', 'Order not found');
        }

        return view('bill', compact('order'));
    }

}
