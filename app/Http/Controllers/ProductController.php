<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

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
        ]);

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'validity' => $request->validity,
            'category_id' => $request->category_id
        ]);

        /**
         * TODO: pegar o UUID da imagem do produto e salvar com o nome
         */

        return response()->json([
            'status' => 'success',
            'message' => 'Product created successfully',
            'user' => $product
        ]);
    }
}
