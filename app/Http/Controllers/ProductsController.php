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
        $products = Product::where('is_active',0)->get();

        // 상품 count 값
        $productCount = Product::where('is_active',0)->count();

        // 카트 값
        $carts = Cart::with('product')
                ->where('user_id', Auth::id())
                ->get();

        // 카트 count 값
        $cartCount = Cart::where('user_id', Auth::id())->sum('quantity');

        // 실행된 쿼리들 확인
        // dd($cartCount->toArray());

        return view('dashboard.index', compact('products','productCount','carts','cartCount'));
    }
}
