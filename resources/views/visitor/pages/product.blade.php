@extends('visitor.layouts.app')
@section('content')
    <div class="container py-4">
        <div class="row">
            <!-- Product Listing -->
            <div class="col-md-12">
                <div class="row" id="product-list">
                    @forelse($products as $product)
                        <div class="col-md-3 mb-4">
                            <div class="card h-100" style="box-shadow:-1px 2px 2px 2px #d3d3d3;">
                                <a href="{{ route('visitor.productDetail', $product->slug) }}">
                                    <div class="overflow-hidden ratio ratio-1x1">
                                        <img src="{{ asset('collection/product/thumbnail/' . $product->productThumbnail) }}"
                                            class="card-img-top h-100 w-100 object-fit-cover"
                                            alt="{{ $product->product_name }}">
                                    </div>
                                </a>
                                <div class="card-body d-flex flex-column">
                                    <h4 class="card-title">{{ $product->productName }}</h4>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p>No products found.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- <input type="hidden" id="next-page-url" value="{{ $products->nextPageUrl() }}"> --}}

            <div class="d-flex justify-content-end visually-hidden" id="pagination-links">
                {{ $products->withQueryString()->links() }}
            </div>
            <div class="text-center mt-3">
                <button id="load-more" class="btn btn-outline-success" data-next-url="{{ $products->nextPageUrl() }}">
                   <i class="fa-solid fa-arrow-down"></i> View More
                </button>
            </div>
        </div>
    </div>
@endsection


{{-- view more button --}}
@push('visitorScript')
    <script>
        $(document).ready(function() {
            $('#load-more').on('click', function() {
                const button = $(this);
                let nextUrl = button.data('next-url');

                if (!nextUrl) {
                    console.warn('No next URL found.');
                    button.remove();
                    return;
                }

                $.ajax({
                    url: nextUrl,
                    type: 'GET',
                    beforeSend: function() {
                        button.text('Loading...').prop('disabled', true);
                    },
                    success: function(response) {
                        const tempDom = $('<div>').html(response);
                        const newItems = tempDom.find(
                            '#product-list > .col-md-3, #product-list > .col-12');

                        const newNextUrl = tempDom.find('#load-more').data('next-url'); // 👈

                        if (newItems.length > 0) {
                            $('#product-list').append(newItems);
                        }

                        if (newNextUrl) {
                            button.data('next-url', newNextUrl);
                            button.prop('disabled', false).text('View More');
                        } else {
                            button.remove();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX error:", error);
                        console.log("Response:", xhr.responseText);
                        alert("Error loading more products.");
                    },
                    complete: function() {
                        console.log('AJAX completed');
                    }
                });
            });
        });
    </script>
@endpush
{{-- view more button --}}
