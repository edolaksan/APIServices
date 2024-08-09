<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Place Your Order</h1>

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('submitOrder') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="table_no" class="block text-sm font-medium">Table Number</label>
                <select name="table_no" id="table_no" class="border rounded p-2 w-full">
                    <option value="MEJA NO 1">MEJA NO 1</option>
                    <option value="MEJA NO 2">MEJA NO 2</option>
                    <option value="MEJA NO 3">MEJA NO 3</option>
                </select>
            </div>

            <div id="order-items" class="mb-4">
                @foreach ($products as $index => $product)
                    <div class="mb-4">
                        <label for="product_{{ $index }}" class="block text-sm font-medium">Product</label>
                        <select name="items[{{ $index }}][product_id]" id="product_{{ $index }}"
                            class="border rounded p-2 w-full">
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        </select>

                        <label for="variant_{{ $index }}" class="block text-sm font-medium mt-2">Variant</label>
                        @php
                            $variants = json_decode($product->variant, true);
                        @endphp
                        @if (!empty($variants))
                            <select name="items[{{ $index }}][variant]" id="variant_{{ $index }}"
                                class="border rounded p-2 w-full">
                                @foreach ($variants as $key => $variant)
                                    <option value="{{ $key }}">{{ $variant }}</option>
                                @endforeach
                            </select>
                        @endif
                        <label for="quantity_{{ $index }}"
                            class="block text-sm font-medium mt-2">Quantity</label>
                        <input type="number" name="items[{{ $index }}][quantity]"
                            id="quantity_{{ $index }}" class="border rounded p-2 w-full" value="1"
                            min="1">
                    </div>
                @endforeach
            </div>

            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Submit</button>
        </form>
    </div>
</body>

</html>
