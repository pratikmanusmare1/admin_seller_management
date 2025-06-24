<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Check if user exists and is an admin
        $user = User::where('email', $request->email)
                   ->where('role', 'admin')
                   ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect or user is not an admin.'],
            ]);
        }

        // Create token for the admin
        $token = $user->createToken('admin-token')->plainTextToken;

        // Return success response with token and user info
        return response()->json([
            'status' => 'success',
            'message' => 'Admin logged in successfully',
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                ],
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]
        ], 200);
    }

    public function createSeller(Request $request)
    {
        try {
            // Validate input
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'mobile_no' => 'required|string|max:20',
                'country' => 'required|string|max:100',
                'state' => 'required|string|max:100',
                'skills' => 'required|array',
                'skills.*' => 'exists:skills,id',
                'password' => 'required|string|min:6',
            ]);

            // Create the seller
            $seller = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'mobile_no' => $validated['mobile_no'],
                'country' => $validated['country'],
                'state' => $validated['state'],
                'role' => 'seller',
                'password' => bcrypt($validated['password']),
            ]);

            // Attach skills
            $seller->skills()->attach($validated['skills']);

            return response()->json([
                'status' => 'success',
                'message' => 'Seller created successfully',
                'data' => [
                    'seller' => $seller->load('skills')
                ]
            ], 201);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create seller. Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function listSellers(Request $request)
    {
        try {
            $perPage = $request->get('per_page', 10); // Default 10 per page
            $sellers = User::where('role', 'seller')->with('skills')->paginate($perPage);
            
            return response()->json([
                'status' => 'success',
                'message' => 'Sellers fetched successfully',
                'data' => $sellers
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch sellers. Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function showSellersList(Request $request)
    {
        // Check if admin is logged in
        if (!session('admin_id')) {
            return redirect()->route('admin.login.form')->withErrors(['error' => 'Please login as admin first.']);
        }
        $perPage = $request->get('per_page', 10); // Default 10 per page
        $sellers = User::where('role', 'seller')->paginate($perPage);
        return view('admin.sellers-list', compact('sellers'));
    }

    public function showSellerLoginForm()
    {
        return view('seller.login');
    }

    public function handleSellerLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)
            ->where('role', 'seller')
            ->first();

        if (!$user || !\Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Invalid credentials or not a seller.'])->withInput();
        }

        // Store seller_id in session
        session(['seller_id' => $user->id]);

        // Redirect to dashboard
        return redirect()->route('seller.dashboard');
    }

    public function sellerLogin(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Check if user exists and is a seller
        $user = User::where('email', $request->email)
                   ->where('role', 'seller')
                   ->first();

        if (!$user || !\Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'The provided credentials are incorrect or user is not a seller.'
            ], 401);
        }

        // Create token for the seller
        $token = $user->createToken('seller-token')->plainTextToken;

        // Return success response with token and user info
        return response()->json([
            'status' => 'success',
            'message' => 'Seller logged in successfully',
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                ],
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]
        ], 200);
    }

    public function sellerDashboard()
    {
        $sellerId = session('seller_id');
        if (!$sellerId) {
            return redirect()->route('seller.login.form')->withErrors(['error' => 'Please login as seller first.']);
        }
        $seller = User::find($sellerId);
        $products = $seller->products()->with('brands')->get();
        return view('seller.dashboard', compact('seller', 'products'));
    }

    public function showAdminLoginForm()
    {
        return view('admin.login');
    }

    public function handleAdminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)
            ->where('role', 'admin')
            ->first();

        if (!$user || !\Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Invalid credentials or not an admin.'])->withInput();
        }

        // Store admin_id in session
        session(['admin_id' => $user->id]);

        // Redirect to sellers list
        return redirect()->route('admin.sellers.list');
    }

    public function sellerLogout()
    {
        session()->forget('seller_id');
        return redirect()->route('seller.login.form')->with('success', 'Logged out successfully!');
    }

    public function adminLogout()
    {
        session()->forget('admin_id');
        return redirect()->route('admin.login.form')->with('success', 'Logged out successfully!');
    }

    public function showAddSellerForm()
    {
        // Check if admin is logged in
        if (!session('admin_id')) {
            return redirect()->route('admin.login.form')->withErrors(['error' => 'Please login as admin first.']);
        }
        $skills = \App\Models\Skill::all();
        return view('admin.add-seller', compact('skills'));
    }

    public function handleAddSeller(Request $request)
    {
        // Check if admin is logged in
        if (!session('admin_id')) {
            return redirect()->route('admin.login.form')->withErrors(['error' => 'Please login as admin first.']);
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'mobile_no' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'skills' => 'required|array',
            'skills.*' => 'exists:skills,id',
            'password' => 'required|string|min:6',
        ]);
        try {
            $seller = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'mobile_no' => $request->mobile_no,
                'country' => $request->country,
                'state' => $request->state,
                'role' => 'seller',
                'password' => bcrypt($request->password),
            ]);
            $seller->skills()->attach($request->skills);
            return redirect()->route('admin.sellers.list')->with('success', 'Seller added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to add seller: ' . $e->getMessage()])->withInput();
        }
    }
}
