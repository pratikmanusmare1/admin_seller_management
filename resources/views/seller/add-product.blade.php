<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function addBrandRow() {
            const brandsDiv = document.getElementById('brands');
            const index = brandsDiv.children.length;
            const brandRow = document.createElement('div');
            brandRow.className = 'row mb-3';
            brandRow.innerHTML = `
                <div class="col-md-3"><input type="text" name="brands[${index}][name]" class="form-control" placeholder="Brand Name" required></div>
                <div class="col-md-3"><input type="text" name="brands[${index}][detail]" class="form-control" placeholder="Detail" required></div>
                <div class="col-md-3"><input type="file" name="brands[${index}][image]" class="form-control"></div>
                <div class="col-md-2"><input type="number" name="brands[${index}][price]" class="form-control" placeholder="Price" required></div>
                <div class="col-md-1"><button type="button" class="btn btn-danger" onclick="this.parentElement.parentElement.remove()">X</button></div>
            `;
            brandsDiv.appendChild(brandRow);
        }
    </script>
</head>
<body>
<div class="container mt-5">
    <h2>Add Product</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('seller.add.product.handle') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Product Name</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
        </div>
        <div class="mb-3">
            <label>Product Description</label>
            <textarea name="description" class="form-control" required>{{ old('description') }}</textarea>
        </div>
        <h5>Brands</h5>
        <div id="brands">
            <div class="row mb-3">
                <div class="col-md-3"><input type="text" name="brands[0][name]" class="form-control" placeholder="Brand Name" required></div>
                <div class="col-md-3"><input type="text" name="brands[0][detail]" class="form-control" placeholder="Detail" required></div>
                <div class="col-md-3"><input type="file" name="brands[0][image]" class="form-control"></div>
                <div class="col-md-2"><input type="number" name="brands[0][price]" class="form-control" placeholder="Price" required></div>
                <div class="col-md-1"></div>
            </div>
        </div>
        <button type="button" class="btn btn-secondary mb-3" onclick="addBrandRow()">Add Another Brand</button>
        <br>
        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
</div>
</body>
</html> 