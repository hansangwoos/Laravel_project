<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
     protected $fillable = [
        'product_id',
        'user_id',
        'quantity',
    ];

    // 카트 -> 상품
    public function product(){
        return $this->belongsTo(Product::class);
    }

    // 카트 -> 유저
    public function user(){
        return $this->belongsTo(User::class);
    }
}
