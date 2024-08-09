<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function createOrder(Request $request)
    {

        // Log the incoming request data
        Log::info('Incoming request data:', $request->all());
        $order = new Order();
        $order->table_no = $request->table_no;
        $order->total_price = 0;
        $order->save();

        $totalPrice = 0;
        $stations = [];

        foreach ($request->items as $item) {
            $product = Product::find($item['product_id']);
            $variant = $item['variant'];

            // Decode JSON and ensure it's an array
            $prices = json_decode($product->price, true);
            $variants = json_decode($product->variant, true);

            // Log for debugging
            Log::info('Prices:', ['prices' => $prices]);
            Log::info('Variants:', ['variants' => $variants]);
            Log::info('Variant:', ['variant' => $variant]);

            // Check if the variant exists in the product
            if (isset($variants[$variant])) {
                if (isset($prices[$variant])) {
                    $price = $prices[$variant];
                } else {
                    return back()->withErrors("Price for variant '{$variant}' not found for product '{$product->name}'");
                }
            } else {
                return back()->withErrors("Variant '{$variant}' not found for product '{$product->name}'");
            }

            $totalPrice += $price * $item['quantity'];

            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $product->id;
            $orderItem->variant = $variant;
            $orderItem->quantity = $item['quantity'];
            $orderItem->price = $price * $item['quantity'];

            $stationPrinter = $this->getStationPrinter($product->category_id);
            $orderItem->station_printers = $stationPrinter;
            array_push($stations, $stationPrinter);

            $orderItem->save();
        }

        $order->total_price = $totalPrice;
        $order->save();

        return redirect()->route('showOrder', ['id' => $order->id]);
    }


    private function getStationPrinter($categoryId)
    {
        switch ($categoryId) {
            case 1:
                return 'C'; // Minuman
            case 2:
                return 'B'; // Makanan
            case 3:
                return 'A'; // Promo (Kasir)
            default:
                return 'A';
        }
    }

    public function showOrderForm()
    {
        $products = Product::all();
        return view('order', compact('products'));
    }

    public function submitOrder(Request $request)
    {
        if (!isset($request->items)) {
            return back()->withErrors('No items found in the order.');
        }

        $order = new Order();
        $order->table_no = $request->table_no;
        $order->total_price = 0;
        $order->save();

        $totalPrice = 0;
        $stations = [];

        foreach ($request->items as $item) {
            if (!isset($item['product_id'])) {
                return back()->withErrors('Product ID is missing in one of the items.');
            }

            $product = Product::find($item['product_id']);
            $variant = $item['variant'];

            // Decode JSON and ensure it's an array
            $prices = json_decode($product->price, true);

            // Log prices and variant for debugging
            Log::info('Prices:', ['prices' => $prices]);
            Log::info('Variant:', ['variant' => $variant]);

            if (is_array($prices) && array_key_exists($variant, $prices)) {
                $price = $prices[$variant];
            } else {
                return back()->withErrors("Variant '{$variant}' not found for product '{$product->name}'");
            }

            $totalPrice += $price * $item['quantity'];

            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $product->id;
            $orderItem->variant = $variant;
            $orderItem->quantity = $item['quantity'];
            $orderItem->price = $price * $item['quantity'];

            $stationPrinter = $this->getStationPrinter($product->category_id);
            $orderItem->station_printers = $stationPrinter;
            array_push($stations, $stationPrinter);

            $orderItem->save();
        }

        $order->total_price = $totalPrice;
        $order->save();

        return redirect()->route('bill', ['orderId' => $order->id]);
    }

    public function showOrder($id)
    {
        $order = Order::with('orderItems.product')->findOrFail($id);
        return view('order-details', compact('order'));
    }


    public function printBill($orderId)
    {
        $order = Order::with('orderItems.product')->findOrFail($orderId);
        return view('print-bill', compact('order'));
    }
}
