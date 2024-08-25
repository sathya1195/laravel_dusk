<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }}</title>
</head>
<body>
    <h1>{{ $product->name }}</h1>

    <p><strong>Description:</strong> {{ $product->description }}</p>

    <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>

    @if($product->imageUrl)
        <div>
            <img src="{{ asset($product->imageUrl) }}" alt="{{ $product->name }}" style="max-width: 400px;">
        </div>
    @endif

    <a href="/products">Back to Products</a>
</body>
</html>
