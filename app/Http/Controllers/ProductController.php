<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Cart;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        $product = new ProductResource($product);
        return inertia('Product/Show', [
            'product' => $product,
        ]);
    }

    public function index()
    {
        $products = ProductResource::collection(
            Product::query()
                ->paginate(8)
                ->withQueryString()
        );
        $cartProducts = Cart::getContent();

        return inertia('Products', [
            'products' => $products,
            'cartProducts' => $cartProducts
        ]);
    }
}
