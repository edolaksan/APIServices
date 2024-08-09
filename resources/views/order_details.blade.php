<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Order Details</h1>

        <p class="mb-4"><strong>Table No:</strong> {{ $order->table_no }}</p>
        <p class="mb-4"><strong>Total Price:</strong> ${{ number_format($order->total_price, 2) }}</p>

        <h2 class="text-xl font-semibold mb-2">Order Items</h2>
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Product</th>
                    <th class="border px-4 py-2">Variant</th>
                    <th class="border px-4 py-2">Quantity</th>
                    <th class="border px-4 py-2">Price</th>
                    <th class="border px-4 py-2">Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse($order->orderItems as $item)
                    <tr>
                        <td class="border px-4 py-2">{{ $item->product->name }}</td>
                        <td class="border px-4 py-2">{{ $item->variant }}</td>
                        <td class="border px-4 py-2">{{ $item->quantity }}</td>
                        <td class="border px-4 py-2">${{ number_format($item->price, 2) }}</td>
                        <td class="border px-4 py-2">${{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="border px-4 py-2 text-center">No items found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <a href="{{ route('showOrderForm') }}" class="mt-4 inline-block bg-blue-500 text-white py-2 px-4 rounded">Back to Order Form</a>
    </div>
</body>
</html>
