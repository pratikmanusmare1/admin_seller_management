# Laravel Pune API Documentation

## Base URL
```
http://127.0.0.1:8000/api
```

## Authentication
All protected endpoints require a Bearer token in the Authorization header:
```
Authorization: Bearer YOUR_ACCESS_TOKEN
```

## HTTP Status Codes Used
- `200` - Success
- `201` - Created
- `401` - Unauthorized
- `403` - Forbidden
- `404` - Not Found
- `422` - Validation Error
- `500` - Server Error

---

## Admin APIs

### 1. Admin Login
**POST** `/admin/login`

**Request Body:**
```json
{
    "email": "admin@example.com",
    "password": "password"
}
```

**Success Response (200):**
```json
{
    "status": "success",
    "message": "Admin logged in successfully",
    "data": {
        "user": {
            "id": 1,
            "name": "Admin User",
            "email": "admin@example.com",
            "role": "admin"
        },
        "access_token": "1|abc123...",
        "token_type": "Bearer"
    }
}
```

**Error Response (401):**
```json
{
    "message": "The provided credentials are incorrect or user is not an admin.",
    "errors": {
        "email": ["The provided credentials are incorrect or user is not an admin."]
    }
}
```

### 2. Create Seller
**POST** `/admin/sellers`

**Headers:** `Authorization: Bearer ADMIN_TOKEN`

**Request Body:**
```json
{
    "name": "Seller Name",
    "email": "seller@example.com",
    "mobile_no": "9876543210",
    "country": "India",
    "state": "Maharashtra",
    "skills": [1, 2],
    "password": "password123"
}
```

**Success Response (201):**
```json
{
    "status": "success",
    "message": "Seller created successfully",
    "data": {
        "seller": {
            "id": 2,
            "name": "Seller Name",
            "email": "seller@example.com",
            "role": "seller",
            "skills": [...]
        }
    }
}
```

**Error Response (422):**
```json
{
    "status": "error",
    "message": "Validation failed",
    "errors": {
        "email": ["The email has already been taken."]
    }
}
```

### 3. List Sellers
**GET** `/admin/sellers?per_page=10`

**Headers:** `Authorization: Bearer ADMIN_TOKEN`

**Success Response (200):**
```json
{
    "status": "success",
    "message": "Sellers fetched successfully",
    "data": {
        "current_page": 1,
        "data": [...],
        "per_page": 10,
        "total": 5
    }
}
```

---

## Seller APIs

### 1. Seller Login
**POST** `/seller/login`

**Request Body:**
```json
{
    "email": "seller@example.com",
    "password": "password123"
}
```

**Success Response (200):**
```json
{
    "status": "success",
    "message": "Seller logged in successfully",
    "data": {
        "user": {
            "id": 2,
            "name": "Seller Name",
            "email": "seller@example.com",
            "role": "seller"
        },
        "access_token": "2|def456...",
        "token_type": "Bearer"
    }
}
```

**Error Response (401):**
```json
{
    "status": "error",
    "message": "The provided credentials are incorrect or user is not a seller."
}
```

### 2. Add Product
**POST** `/seller/products`

**Headers:** `Authorization: Bearer SELLER_TOKEN`

**Request Body (form-data):**
```
name: Product Name
description: Product Description
brands[0][name]: Dell
brands[0][detail]: Test
brands[0][image]: [file]
brands[0][price]: 1000
brands[1][name]: HP
brands[1][detail]: Test
brands[1][image]: [file]
brands[1][price]: 2000
```

**Success Response (201):**
```json
{
    "status": "success",
    "message": "Product added successfully",
    "data": {
        "id": 1,
        "name": "Product Name",
        "description": "Product Description",
        "seller_id": 2,
        "brands": [...]
    }
}
```

**Error Response (403):**
```json
{
    "status": "error",
    "message": "Unauthorized access. Only authenticated sellers can add products."
}
```

**Error Response (422):**
```json
{
    "status": "error",
    "message": "Validation failed",
    "errors": {
        "brands.0.price": ["The brands.0.price field must be a number."]
    }
}
```

### 3. Delete Product
**DELETE** `/seller/products/{id}`

**Headers:** `Authorization: Bearer SELLER_TOKEN`

**Success Response (200):**
```json
{
    "status": "success",
    "message": "Product deleted successfully."
}
```

**Error Response (403):**
```json
{
    "status": "error",
    "message": "Unauthorized access. Only authenticated sellers can delete products."
}
```

**Error Response (404):**
```json
{
    "status": "error",
    "message": "Product not found or you do not have permission to delete this product."
}
```

---

## Web Routes (UI)

### Seller Login Page
**GET** `/seller/login`

### Seller Dashboard
**GET** `/seller/dashboard`

### Add Product Form
**GET** `/seller/add-product`

### Admin Sellers List
**GET** `/admin/sellers-list`

---

## Error Handling

All APIs follow consistent error handling patterns:

1. **Validation Errors (422):** Return detailed field-specific errors
2. **Authentication Errors (401):** Invalid credentials
3. **Authorization Errors (403):** Insufficient permissions
4. **Not Found Errors (404):** Resource doesn't exist
5. **Server Errors (500):** Internal server errors with generic messages

## Security Features

- Sanctum token-based authentication
- Role-based access control (admin/seller)
- Input validation and sanitization
- SQL injection protection via Eloquent ORM
- CSRF protection for web forms
- File upload validation and storage 