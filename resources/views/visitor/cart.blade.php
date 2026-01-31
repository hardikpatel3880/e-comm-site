@extends('visitor.layouts.app')

@section('content')
<div class="container cart-page mt-5 mb-5">
    <h2 class="page-title mb-4">Shopping Cart</h2>

    @if($cartItems->count() > 0)
        <div class="row">
            <div class="col-lg-8">
                <div class="cart-items">
                    @foreach($cartItems as $item)
                        <div class="cart-item" id="cart-item-{{ $item->id }}">
                            <div class="item-image">
                                <img src="{{asset('collection/product/thumbnail/' . $item->product->productThumbnail) }}" 
                                     alt="{{ $item->product->productName }}">
                            </div>
                            <div class="item-details">
                                <h5 class="item-name">{{ $item->product->productName }}</h5>
                                @if($item->size)
                                    <p class="item-variant">Size: {{ $item->size }}</p>
                                @endif
                                @if($item->color)
                                    <p class="item-variant">Color: {{ $item->color }}</p>
                                @endif
                            </div>
                            <div class="item-price">
                                ₹{{ number_format($item->price) }}
                            </div>
                            <div class="item-quantity">
                                <div class="input-group">
                                    <button class="btn btn-outline-secondary btn-sm" 
                                            onclick="updateQuantity({{ $item->id }}, {{ $item->quantity - 1 }})">-</button>
                                    <input type="number" class="form-control text-center" 
                                           value="{{ $item->quantity }}" 
                                           id="quantity-{{ $item->id }}" readonly>
                                    <button class="btn btn-outline-secondary btn-sm" 
                                            onclick="updateQuantity({{ $item->id }}, {{ $item->quantity + 1 }})">+</button>
                                </div>
                            </div>
                            <div class="item-subtotal" id="subtotal-{{ $item->id }}">
                                ₹{{ number_format($item->subtotal) }}
                            </div>
                            <div class="item-remove">
                                <button class="btn btn-sm btn-danger" onclick="removeItem({{ $item->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-4">
                <div class="cart-summary">
                    <h4>Cart Summary</h4>
                    <div class="summary-row">
                        <span>Subtotal:</span>
                        <span id="cart-total">₹{{ number_format($total) }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Shipping:</span>
                        <span>Free</span>
                    </div>
                    <hr>
                    <div class="summary-row total">
                        <strong>Total:</strong>
                        <strong id="cart-grand-total">₹{{ number_format($total) }}</strong>
                    </div>
                    <a href="" class="btn btn-checkout w-100 mt-3">
                        Proceed to Checkout
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="empty-cart text-center">
            <i class="fas fa-shopping-cart fa-4x mb-3" style="color: #ddd;"></i>
            <h3>Your cart is empty</h3>
            <p>Add some items to get started!</p>
            <a href="/" class="btn btn-primary mt-3">Continue Shopping</a>
        </div>
    @endif
</div>

<script>
function updateQuantity(cartId, newQuantity) {
    if (newQuantity < 1) return;

    fetch(`/cart/update/${cartId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ quantity: newQuantity })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById(`quantity-${cartId}`).value = newQuantity;
            document.getElementById(`subtotal-${cartId}`).textContent = '₹' + data.subtotal.toLocaleString();
            location.reload(); // Reload to update totals
        }
    });
}

function removeItem(cartId) {
    if (!confirm('Remove this item from cart?')) return;

    fetch(`/cart/remove/${cartId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.reload();
            document.getElementById(`cart-item-${cartId}`).remove();
            document.getElementById('cart-count').textContent = data.cartCount;
        }
    });
}
</script>
<style>
.cart-item {
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 20px;
    border: 1px solid #e5e5e5;
    border-radius: 8px;
    margin-bottom: 15px;
}

.item-image img {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 8px;
}

.item-details {
    flex: 1;
}

.item-name {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 5px;
}

.item-variant {
    font-size: 14px;
    color: #666;
    margin: 0;
}

.cart-summary {
    background-color: #f9f9f9;
    padding: 30px;
    border-radius: 8px;
    position: sticky;
    top: 100px;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
}

.summary-row.total {
    font-size: 20px;
}

.btn-checkout {
    background-color: #DB4444;
    color: white;
    padding: 15px;
    font-size: 16px;
    font-weight: 600;
    border: none;
}

.btn-checkout:hover {
    background-color: #c23838;
}
</style>
@endsection
