@extends('visitor.layouts.app')

@section('content')
<style>
.carousel-indicators {
    position: absolute;
    display: flex;
    justify-content: center !important;
}

.carousel-indicators [data-bs-target] {
    width: 16px;
    height: 16px;
    border-radius: 50%;
    background-color: white;               /* Inactive: white fill */
    border: 2px solid #4f5660;             /* Outer ring */
    position: relative;
    margin: 0 2px;
    padding: 0;
    opacity: 1;
    box-sizing: border-box;
    transition: all 0.3s ease;
}

/* Active indicator styling */
.carousel-indicators .active {
    background-color: white; /* Keep white background */
}

/* Inner dark dot for active */
.carousel-indicators .active::after{
    content: "";
    width: 8px;
    height: 8px;
    background-color: #4f5660;             /* Inner dot color */
    border-radius: 50%;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    transition: all 0.3s ease;  /* Smooth transition for the inner dot */
}

/* Hover effect: show the inner dot with transition */
.carousel-indicators [data-bs-target]:not(.active):hover::after {
    content: "";
    width: 8px;
    height: 8px;
    background-color: #4f5660;             /* Inner dot color */
    border-radius: 50%;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    transition: all 0.3s ease;  /* Smooth transition for the inner dot */
}

.carousel-dark .carousel-indicators [data-bs-target]:not(.active) {
    background-color: white;
}

.carousel-dark .carousel-indicators [data-bs-target].active {
    background-color: transparent;
}

.carousel-indicators [data-bs-target]:not(.active):hover {
    background-color: transparent;  
    cursor: pointer;           
}


</style>

<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">

    <div class="carousel-indicators">
        @foreach ($slider as $key => $sliderData)
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to={{ $key }} class="@if ($key == 0) active selected @endif " aria-current="true" aria-label="Slide 1"></button>
        @endforeach
        <div class="tp-bullet selected" style="left: 0px; top: 0px;"><span class="tp-bullet-inner"></span></div>
    </div>

    <div class="carousel-inner">

        @foreach ($slider as $key => $sliderData)

        <div class="carousel-item @if ($key === 0) active @endif" data-bs-interval="8000">
                <img src="{{ asset('collection/slider/image/' . $sliderData->image) }}" class="d-block w-100 " alt="Slider Image" />
        </div>
        @endforeach

    </div>
</div>

    <div class="container py-4">
        <div class="row">
            <h1 class="display-6 pt-3">Best Seller</h1>
            @foreach ($products as $product)
                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <a href="{{ route('visitor.productDetail', $product->slug) }}" class="link-underline-light">
                        <div class="card h-100 " style="box-shadow:-1px 2px 2px 2px #d3d3d3;">
                            <div class="overflow-hidden ratio ratio-1x1">
                                <img src="{{ asset('collection/product/thumbnail/' . $product->productThumbnail) }}"
                                    title="product" class="card-img-top" style="object-fit: cover;"
                                    alt="{{ $product->productName }}">
                            </div>

                            <div class="card-body d-flex flex-column">

                                <h5 class="card-title">
                                    {{ $product->productName }}
                                </h5>


                                {{-- Buttons --}}
                                {{-- <div
                                class="mt-auto action-buttons mb-2 d-flex flex-row gap-2 align-items-center justify-content-center text-truncate">
                                <a href="javascript:void(0)" class="btn btn-success add-to-cart-btn flex-fill"
                                    data-product-id="{{ $product->id }}">
                                    <i class="fa-solid fa-bag-shopping"></i> @lang('lang.Buy_Now')
                                </a>
                            </div> --}}

                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <a href="{{ route('visitor.product') }}" class="btn btn-outline-warning"><i class="fa fa-shopping-bag"
                        aria-hidden="true"></i> Shop</a>
            </div>
        </div>
    </div>
@endsection
