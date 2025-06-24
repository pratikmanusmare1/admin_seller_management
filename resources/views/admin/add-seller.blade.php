<!DOCTYPE html>
<html>
<head>
    <title>Add Seller</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5" style="max-width: 600px;">
    <h2 class="mb-4">Add New Seller</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('admin.sellers.add.handle') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="mb-3">
            <label for="mobile_no" class="form-label">Mobile No</label>
            <input type="text" class="form-control" id="mobile_no" name="mobile_no" value="{{ old('mobile_no') }}" required>
        </div>
        <div class="mb-3">
            <label for="country" class="form-label">Country</label>
            <input type="text" class="form-control" id="country" name="country" value="{{ old('country') }}" required>
        </div>
        <div class="mb-3">
            <label for="state" class="form-label">State</label>
            <input type="text" class="form-control" id="state" name="state" value="{{ old('state') }}" required>
        </div>
        <div class="mb-3">
            <label for="skills" class="form-label">Skills</label>
            <select class="form-select" id="skills" name="skills[]" multiple required>
                @foreach ($skills as $skill)
                    <option value="{{ $skill->id }}" {{ (collect(old('skills'))->contains($skill->id)) ? 'selected' : '' }}>{{ $skill->name }}</option>
                @endforeach
            </select>
            <small class="text-muted">Hold Ctrl (Windows) or Cmd (Mac) to select multiple skills.</small>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-success">Add Seller</button>
        <a href="{{ route('admin.sellers.list') }}" class="btn btn-secondary">Back to List</a>
    </form>
</div>
</body>
</html> 