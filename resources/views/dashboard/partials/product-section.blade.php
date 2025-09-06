<p class="cart-header-text">현재 상품목록에 <strong id="cart-count">{{ $productCount }}</strong>개 상품이 있습니다.</p>
@if($products->isEmpty())
    <p class="empty-cart-message">상품목록이 비어있습니다</p>
@else
<div class="product-list">
    @foreach($products as $product)
        <div class="product-item">
            <div class="product-item-info">
                <span class="product-name">{{ $product->name }}</span>
                <span class="product-price">₩ {{ number_format($product->price,0)}}</span>
            </div>
            <div class="product-item-actions">
                <button class="btn btn-sm btn-success" data-id="{{ $product->id }}" data-action="addToCart" data-name="{{ $product->name }}" data-price="{{ $product->price }}">담기</button>
                <button class="btn btn-sm btn-danger" data-id="{{ $product->id }}" data-action="deleteProduct">삭제</button>
            </div>
        </div>
    @endforeach
</div>
<div class="product-actions-section">
    <button class="product-add-all-btn" data-action="addAllToCart">전체 담기</button>
</div>
@endif
