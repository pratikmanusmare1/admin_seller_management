<!DOCTYPE html>
<html>
<head>
    <title>Seller Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <form action="{{ route('seller.logout') }}" method="POST" class="d-inline float-end">
        @csrf
        <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
    </form>
    <h2>Welcome, {{ $seller->name }}!</h2>
    <p><strong>Email:</strong> {{ $seller->email }}</p>
    <p><strong>Role:</strong> {{ $seller->role }}</p>
    <div class="alert alert-success mt-4">You are logged in as a seller!</div>
    <a href="{{ route('seller.add.product.form') }}" class="btn btn-primary mb-3">Add Product</a>
    <h4>Your Products</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Brands</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>
                        <ul>
                        @foreach ($product->brands as $brand)
                            <li>
                                <strong>{{ $brand->name }}</strong> ({{ $brand->detail }}) - ₹{{ $brand->price }}
                                @if($brand->image)
                                    <br><img src="{{ asset('storage/'.$brand->image) }}" width="50"/>
                                @endif
                            </li>
                        @endforeach
                        </ul>
                        <form action="{{ route('seller.product.delete', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm mt-2" onclick="return confirm('Are you sure you want to delete this product?')">Delete Product</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">No products found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
</body>
</html> 