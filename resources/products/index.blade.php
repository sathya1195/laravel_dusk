<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products</title>
</head>
<body>
    <h1>All Products</h1>

    <!-- Check if there are any products -->
    @if($products->isEmpty())
        <p>No products available.</p>
    @else
        <ul>
            @foreach($products as $product)
                <li>
                    <strong>{{ $product->name }}</strong><br>
                    Description: {{ $product->description }}<br>
                    Price: ${{ number_format($product->price, 2) }}<br>
                    @if($product->imageUrl)
                        <img src="{{ asset($product->imageUrl) }}" alt="{{ $product->name }}" style="max-width: 200px;">
                    @endif
                </li>
                <hr>
            @endforeach
        </ul>
    @endif

    <a href="/products/create">Create a new product</a>
</body>
</html>
