<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;

class SellerController extends Controller
{
    public function addProduct(Request $request)
    {
        try {
            $user = Auth::user();
            if (!$user || $user->role !== 'seller') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized access. Only authenticated sellers can add products.'
                ], 403);
            }

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'brands' => 'required|array|min:1',
                'brands.*.name' => 'required|string|max:255',
                'brands.*.detail' => 'required|string',
                'brands.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'brands.*.price' => 'required|numeric|min:0',
            ]);

            DB::beginTransaction();
            
            $product = Product::create([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'seller_id' => $user->id,
            ]);

            foreach ($request->brands as $brandData) {
                $imagePath = null;
                if (isset($brandData['image']) && $brandData['image']) {
                    $imagePath = $brandData['image']->store('brands', 'public');
                }
                $product->brands()->create([
                    'name' => $brandData['name'],
                    'detail' => $brandData['detail'],
                    'image' => $imagePath,
                    'price' => $brandData['price'],
                ]);
            }

            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Product added successfully',
                'data' => $product->load('brands')
            ], 201);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add product. Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function showAddProductForm()
    {
        return view('seller.add-product');
    }

    public function handleAddProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'brands' => 'required|array|min:1',
            'brands.*.name' => 'required|string|max:255',
            'brands.*.detail' => 'required|string',
            'brands.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'brands.*.price' => 'required|numeric|min:0',
        ]);

        \DB::beginTransaction();
        try {
            // For demo, seller_id = 2 (aap chahe toh session ya Auth se le sakte ho)
            $sellerId = 2;
            $product = \App\Models\Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'seller_id' => $sellerId,
            ]);

            foreach ($request->brands as $i => $brandData) {
                $imagePath = null;
                if (isset($brandData['image']) && $brandData['image']) {
                    $imagePath = $brandData['image']->store('brands', 'public');
                }
                $product->brands()->create([
                    'name' => $brandData['name'],
                    'detail' => $brandData['detail'],
                    'image' => $imagePath,
                    'price' => $brandData['price'],
                ]);
            }

            \DB::commit();
            return redirect()->back()->with('success', 'Product added successfully!');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Failed to add product: ' . $e->getMessage()])->withInput();
        }
    }

    public function deleteProduct($id)
    {
        try {
            $user = Auth::user();
            if (!$user || $user->role !== 'seller') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized access. Only authenticated sellers can delete products.'
                ], 403);
            }

            $product = Product::where('id', $id)->where('seller_id', $user->id)->first();
            
            if (!$product) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Product not found or you do not have permission to delete this product.'
                ], 404);
            }

            $product->delete();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Product deleted successfully.'
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete product. Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteProductWeb($id)
    {
        $sellerId = session('seller_id');
        if (!$sellerId) {
            return redirect()->route('seller.login.form')->withErrors(['error' => 'Please login as seller first.']);
        }
        $product = \App\Models\Product::where('id', $id)->where('seller_id', $sellerId)->first();
        if (!$product) {
            return redirect()->back()->withErrors(['error' => 'Product not found or not yours.']);
        }
        try {
            $product->delete();
            return redirect()->back()->with('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to delete product: ' . $e->getMessage()]);
        }
    }
}
