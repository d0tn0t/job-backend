<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Register a new category
     */
    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        $category = Category::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Category created successfully',
            'category' => $category
        ]);
    }

    /**
     * List of categories
     */
    public function getList(Request $request) {
        $categories = Category::all();

        return response()->json([
            'categories' => $categories
        ]);
    }

    /**
     * Update a category
     */
    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        try {
            $category = Category::find((int)$id);

            $category->name = $request->name;
    
            $category->save();
    
    
            return response()->json([
                'status' => 'success',
                'message' => 'Category updated successfully',
                'category' => $category
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'fail',
                'message' => $e->getMessage(),
            ], $e->status);
        }
    }

    /**
     * Soft delete a category
     */
    public function remove(Request $request, $id) {
        try {
            $category = Category::find((int)$id);
            $category->delete();
    
            return response()->json([
                'status' => 'success',
                'message' => 'Category removed successfully',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'fail',
                'message' => $e->getMessage(),
            ], $e->status);
        }
    }
}
