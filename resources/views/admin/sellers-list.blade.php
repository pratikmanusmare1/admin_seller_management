<!DOCTYPE html>
<html>
<head>
    <title>Sellers List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .badge-skill {
            background: linear-gradient(45deg, #4ecdc4, #44a08d);
            color: white;
            margin-right: 4px;
        }
        .table thead th {
            background: #667eea;
            color: white;
        }
        .search-box {
            max-width: 350px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <form action="{{ route('admin.logout') }}" method="POST" class="d-inline float-end ms-2">
        @csrf
        <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
    </form>
    <a href="{{ route('admin.sellers.add.form') }}" class="btn btn-success btn-sm float-end">+ Add Seller</a>
    <h2 class="mb-4 text-center fw-bold">All Sellers <span class="fs-5 text-secondary">(Admin Panel)</span></h2>
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
    <form method="GET" class="mb-3 d-flex justify-content-end align-items-center gap-2">
        <input type="text" name="search" class="form-control search-box" placeholder="Search by name or email..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Search</button>
        <a href="{{ route('admin.sellers.list') }}" class="btn btn-secondary">Reset</a>
    </form>
    <form method="GET" class="mb-3">
        <label for="per_page">Show per page:</label>
        <select name="per_page" id="per_page" class="form-select d-inline-block w-auto" onchange="this.form.submit();">
            <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
            <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
        </select>
    </form>
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile No</th>
                    <th>Country</th>
                    <th>State</th>
                    <th>Skills</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sellers as $seller)
                    <tr>
                        <td>{{ $seller->id }}</td>
                        <td>{{ $seller->name }}</td>
                        <td>{{ $seller->email }}</td>
                        <td>{{ $seller->mobile_no }}</td>
                        <td>{{ $seller->country }}</td>
                        <td>{{ $seller->state }}</td>
                        <td>
                            @if($seller->skills && count($seller->skills))
                                @foreach($seller->skills as $skill)
                                    <span class="badge badge-skill">{{ $skill->name }}</span>
                                @endforeach
                            @else
                                <span class="text-muted">No skills</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $sellers->appends(request()->query())->links() }}
    </div>
</div>
</body>
</html>
