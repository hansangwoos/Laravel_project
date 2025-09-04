<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;


class ProductsController extends Controller
{
    public function index(){
        // 상품값
        $products = Product::where('is_active',1)->get();

        // 카트 값
        $carts = Cart::with('product')
                ->where('user_id', Auth::id())
                ->get();

        return view('dashboard.index', compact('products','carts'));
    }
}
