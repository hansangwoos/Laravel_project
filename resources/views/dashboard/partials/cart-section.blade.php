<p class="cart-header-text">현재 장바구니에 <strong id="cart-count">{{ $cartCount }}</strong>개 상품이 있습니다.</p>
@if($carts->isEmpty())
    <p class="empty-cart-message">장바구니가 비어있습니다</p>
@else
    <div class="cart-items-container">
        @foreach($carts as $item)
        <div class="cart-item">
            <div class="cart-item-info">
                <span class="cart-product-name">{{ $item->product->name }}</span>
                <span class="cart-product-price">₩ {{ number_format($item->product->price,0)}}</span>
            </div>
            <div class="cart-quantity-controls">
                <button class="quantity-btn decrease-btn" data-id="{{ $item->id }}" data-action="decreaseQuantity">-</button>
                <span class="cart-quantity-display">{{ $item->quantity }}</span>
                <button class="quantity-btn increase-btn" data-id="{{ $item->id }}" data-action="increaseQuantity">+</button>
            </div>
        </div>
        @endforeach
    </div>
    <div class="cart-clear-section">
        <button class="cart-clear-btn" data-action="clearCart">전체 삭제</button>
    </div>
@endif
