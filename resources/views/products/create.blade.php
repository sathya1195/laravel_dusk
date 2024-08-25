<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
</head>
<body>
    <h1>Create a New Product</h1>

    <!-- Display success message -->
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <!-- Display validation errors -->
    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li style="color: red;">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <!-- Product creation form -->
    <form action="/products" method="POST">
        @csrf

        <div>
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" value="" required>
        </div>

        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description"></textarea>
        </div>

        <div>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" value="" required>
        </div>

        <div>
            <button type="submit">Save</button>
        </div>
    </form>
</body>
</html>
