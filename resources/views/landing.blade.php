<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Pune Marketplace</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 100px 0;
        }
        .feature-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-5px);
        }
        .btn-custom {
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-admin {
            background: linear-gradient(45deg, #ff6b6b, #ee5a24);
            border: none;
            color: white;
        }
        .btn-admin:hover {
            background: linear-gradient(45deg, #ee5a24, #ff6b6b);
            transform: scale(1.05);
            color: white;
        }
        .btn-seller {
            background: linear-gradient(45deg, #4ecdc4, #44a08d);
            border: none;
            color: white;
        }
        .btn-seller:hover {
            background: linear-gradient(45deg, #44a08d, #4ecdc4);
            transform: scale(1.05);
            color: white;
        }
        .stats-section {
            background: #f8f9fa;
            padding: 60px 0;
        }
        .stat-card {
            text-align: center;
            padding: 30px;
        }
        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #667eea;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-store me-2"></i>
                Laravel Pune Marketplace
            </a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-4">
                Welcome to Laravel Pune Marketplace
            </h1>
            <p class="lead mb-5">
                A powerful platform connecting sellers and customers. 
                Manage products, handle multiple brands, and grow your business with ease.
            </p>
            <div class="row justify-content-center">
                <div class="col-md-4 mb-3">
                    <a href="{{ route('seller.login.form') }}" class="btn btn-seller btn-custom btn-lg w-100">
                        <i class="fas fa-user-tie me-2"></i>
                        Seller Login
                    </a>
                </div>
                <div class="col-md-4 mb-3">
                    <a href="{{ route('admin.sellers.list') }}" class="btn btn-admin btn-custom btn-lg w-100">
                        <i class="fas fa-user-shield me-2"></i>
                        Admin Panel
                    </a>
                </div>
            </div>
        </div>
    </section>

    
    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-number">100+</div>
                        <p class="text-muted">Active Sellers</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-number">500+</div>
                        <p class="text-muted">Products Listed</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-number">50+</div>
                        <p class="text-muted">Brands Available</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-number">24/7</div>
                        <p class="text-muted">Support Available</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p class="mb-0">
                &copy; 2024 Laravel Pune Marketplace. Built with Laravel and Bootstrap.
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 