<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Product;
use Ramsey\Uuid\Uuid;

class ProductController extends Controller
{
    /**
     * Register a new product
     */
    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:200',
            'price' => 'required|decimal:2',
            'validity' => 'required|after:yesterday',
            'category_id' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);


        $image_name = Uuid::uuid4() . '.' . $request->image->extension();

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'validity' => $request->validity,
            'category_id' => $request->category_id,
            'image' => $image_name,
        ]);

        try {
            $request->file('image')->storeAs(
                'images', $image_name
            );
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'success',
                'message' => $e,
            ]);
        }
        

        return response()->json([
            'status' => 'success',
            'message' => 'Product created successfully',
            'product' => $product
        ]);
    }

    /**
     * List of products
     */
    public function getList(Request $request) {
        $products = Product::with('category')->get();

        return response()->json([
            'products' => $products
        ]);
    }

    /**
     * Update a product
     */
    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:200',
            'price' => 'required|decimal:2',
            'validity' => 'required|after:yesterday',
            'category_id' => 'required|integer',
            'image' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        $product = Product::find((int)$id);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->validity = $request->validity;
        $product->category_id = $request->category_id;


        if( $request->file('image') != null) {
            Storage::delete('images/' . $product->image);

            $stored_name = explode('.', $product->image)[0];
            $image_name = $stored_name. '.' . $request->image->extension();

            $product->image = $image_name;

            try {
                $request->file('image')->storeAs(
                    'images', $image_name
                );
            } catch (\Throwable $e) {
                return response()->json([
                    'status' => 'success',
                    'message' => $e,
                ]);
            }            
        }

        $product->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Product updated successfully',
            'product' => $product
        ]);
    }
    
    /**
     * Remove a product
     */
    public function remove(Request $request, $id) {
        try {
            $product = Product::find((int)$id);

            if($product != null) {
                Storage::delete('images/' . $product->image);
    
                $product->delete();
        
                return response()->json([
                    'status' => 'success',
                    'message' => 'Product removed successfully',
                ]);
            } else {
                return response()->json([
                    'status' => 'fail',
                    'message' => 'Product not found',
                ], 400);
            }

        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'fail',
                'message' => $e->getMessage(),
            ], $e->status);
        }
    }    
}
