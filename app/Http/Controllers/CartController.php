<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{

    public function addToCart(Request $request){
        $productId = $request->input('productId');
        $userId = Auth::id();

        $existingCart = Cart::where('user_id', $userId)
                            ->where('product_id', $productId)
                            ->first();

        if($existingCart){
            $existingCart->quantity += 1;
            $existingCart->save();
        }else {
            Cart::create([
                'product_id' => $productId,
                'user_id' => $userId,
                'quantity' => 1
            ]);
        }

        // 업데이트 된 장바구니 정보
        $cartCount = Cart::where('user_id', $userId)->sum('quantity');
        $carts = Cart::with('product')
                ->where('user_id', $userId)
                ->get();

        // 랜더링
        $cartHtml = view('dashboard.partials.cart-section', compact('carts','cartCount'))->render();
        return response()->json([
            'success'=> true,
            'cartHtml'=>$cartHtml,
        ]);
    }

    // 전체삭제
    public function clearCart(){
        Cart::where('user_id',Auth::id())->delete();

        // 삭제 후 빈 장바구니 상태로 다시 조회
        $cartCount = 0; // 또는 Cart::where('user_id', $userId)->sum('quantity');
        $carts = collect(); // 빈 컬렉션, 또는 Cart::with('product')->where('user_id', $userId)->get();

        // 랜더링
        $cartHtml = view('dashboard.partials.cart-section', compact('carts','cartCount'))->render();
        return response()->json([
            'success'=>true,
            'cartHtml'=>$cartHtml,
        ]);
    }

}
