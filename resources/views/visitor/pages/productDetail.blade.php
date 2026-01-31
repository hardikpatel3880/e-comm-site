@extends('visitor.layouts.app')

@push('metaTitle')
    <title>{{ $product->productName ?? 'Product Detail' }}</title>
    <meta name="description" content="{{ $product->productDescription ?? '' }}">
    <meta property="og:image" content="{{ $product->productThumbnail ?? '' }}">
@endpush

@section('content')
<div class="container mt-5 mb-5">
    @if($product)
        <div class="row">
            <!-- Product Images -->
            <div class="col-md-6">
                <div class="product-images">
                    <img src="{{ asset('collection/product/thumbnail/' . $product->productThumbnail) }}" 
                         alt="{{ $product->productName }}" 
                         class="img-fluid main-product-image"
                         id="mainImage">
                    
                    @if($product->images && count($product->images) > 0)
                        <div class="product-thumbnails mt-3">
                            @foreach($product->images as $image)
                                <img src="{{ asset('storage/' . $image->image_path) }}" 
                                     alt="{{ $product->productName }}" 
                                     class="img-thumbnail thumbnail-image"
                                     onclick="changeMainImage(this.src)">
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- Product Details -->
            <div class="col-md-6">
                <h1 class="product-title">{{ $product->productName }}</h1>
                
                <div class="product-price mb-3">
                    <h3 class="price">₹{{ number_format($product->productPrice) }}</h3>
                </div>

                <div class="product-description mb-4">
                    <p>{!! nl2br(e($product->productDescription)) !!}</p>
                </div>

                <!-- Size Selection -->
                @if($product->sizes && count($product->sizes) > 0)
                    <div class="product-sizes mb-3">
                        <label class="form-label"><strong>Size:</strong></label>
                        <div class="size-options">
                            @foreach($product->sizes as $sizeItem)
                                <input type="radio" 
                                       class="btn-check" 
                                       name="size" 
                                       id="size-{{ $sizeItem->size->id }}" 
                                       value="{{ $sizeItem->size->name }}"
                                       autocomplete="off">
                                <label class="btn btn-outline-dark btn-size" 
                                       for="size-{{ $sizeItem->size->id }}">
                                    {{ $sizeItem->size->name }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(Auth::check())

                <!-- Quantity -->
                <div class="product-quantity mb-4">
                    <label class="form-label"><strong>Quantity:</strong></label>
                    <div class="input-group quantity-input" style="max-width: 150px;">
                        <button class="btn btn-outline-secondary" type="button" onclick="decreaseQuantity()">-</button>
                        <input type="number" class="form-control text-center" id="quantity" value="1" min="1">
                        <button class="btn btn-outline-secondary" type="button" onclick="increaseQuantity()">+</button>
                    </div>
                </div>

                <!-- Add to Cart Button -->
                <div class="product-actions">
                    <button type="button" class="btn btn-add-to-cart" onclick="addToCart({{ $product->id }})">
                        <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                    </button>
                    <button type="button" class="btn btn-wishlist ms-2">
                        <i class="far fa-heart"></i>
                    </button>
                </div>
                @endif
            </div>
        </div>
    @else
        <div class="alert alert-warning">
            <p>No product found.</p>
        </div>
    @endif
</div>

<script>
// Change main product image
function changeMainImage(src) {
    document.getElementById('mainImage').src = src;
}

// Increase quantity
function increaseQuantity() {
    let quantityInput = document.getElementById('quantity');
    quantityInput.value = parseInt(quantityInput.value) + 1;
}

// Decrease quantity
function decreaseQuantity() {
    let quantityInput = document.getElementById('quantity');
    if (parseInt(quantityInput.value) > 1) {
        quantityInput.value = parseInt(quantityInput.value) - 1;
    }
}

// Add to cart function
function addToCart(productId) {
    const quantity = document.getElementById('quantity').value;
    const sizeElement = document.querySelector('input[name="size"]:checked');
    const colorElement = document.querySelector('input[name="color"]:checked');
    
    const size = sizeElement ? sizeElement.value : null;
    const color = colorElement ? colorElement.value : null;

    // Show loading state
    const btn = event.target.closest('button');
    const originalText = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...';
    btn.disabled = true;

    fetch('{{ route("cart.add") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: quantity,
            size: size,
            color: color
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update cart count in header
            updateCartCount();
            
            // Show success message
            showToast('success', data.message);
            
            // Reset button
            btn.innerHTML = originalText;
            btn.disabled = false;
        } else {
            if (data.redirect) {
                // Redirect to login if not authenticated
                window.location.href = data.redirect;
            } else {
                showToast('error', data.message);
                btn.innerHTML = originalText;
                btn.disabled = false;
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('error', 'Something went wrong. Please try again.');
        btn.innerHTML = originalText;
        btn.disabled = false;
    });
}

// Update cart count in header
function updateCartCount() {
    fetch('{{ route("cart.count") }}')
        .then(response => response.json())
        .then(data => {
            const cartCountElement = document.getElementById('cart-count');
            if (cartCountElement) {
                cartCountElement.textContent = data.count;
                if (data.count > 0) {
                    cartCountElement.style.display = 'flex';
                }
            }
        });
}

// Toast notification function
function showToast(type, message) {
    // You can use any toast library or create custom toast
    // Using simple alert for now
    if (type === 'success') {
        alert('✓ ' + message);
    } else {
        alert('✗ ' + message);
    }
}
</script>

<style>
.product-title {
    font-size: 32px;
    font-weight: 600;
    margin-bottom: 20px;
}

.product-price .price {
    color: #DB4444;
    font-size: 28px;
    font-weight: 700;
}

.product-description {
    font-size: 16px;
    line-height: 1.8;
    color: #555;
}

.main-product-image {
    border-radius: 8px;
    max-height: 600px;
    object-fit: cover;
}

.product-thumbnails {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.thumbnail-image {
    width: 80px;
    height: 80px;
    object-fit: cover;
    cursor: pointer;
    transition: transform 0.3s;
}

.thumbnail-image:hover {
    transform: scale(1.1);
}

.btn-size {
    margin-right: 10px;
    margin-bottom: 10px;
}

.quantity-input .btn {
    width: 40px;
}

.btn-add-to-cart {
    background-color: #DB4444;
    color: white;
    padding: 12px 40px;
    font-size: 16px;
    font-weight: 500;
    border: none;
    border-radius: 4px;
    transition: background-color 0.3s;
}

.btn-add-to-cart:hover {
    background-color: #c23838;
    color: white;
}

.btn-wishlist {
    background-color: white;
    border: 2px solid #DB4444;
    color: #DB4444;
    padding: 12px 20px;
    border-radius: 4px;
}

.btn-wishlist:hover {
    background-color: #DB4444;
    color: white;
}
</style>
@endsection
