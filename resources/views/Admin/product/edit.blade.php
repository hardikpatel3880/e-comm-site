@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Update Product</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary btn-sm mb-2" href="{{ route('product.index') }}"><i class="fa fa-arrow-left"></i>
                Back</a>
        </div>
    </div>
</div>

@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="productName" placeholder="ProductName" id="productName" class="form-control"
                    value="{{ $product->productName }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
            <div class="form-group">
                <strong>Slug:</strong>
                <input type="text" name="slug" placeholder="Slug" id="slug" class="form-control"
                    value="{{ $product->slug }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
            <div class="form-group">
                <strong>Description:</strong>
                <textarea name="productDescription" id="productDescription" placeholder="ProductDescription"
                    class="form-control" rows="4">{{ $product->productDescription }}</textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
            <div class="form-group">
                <strong>Price:</strong>
                <input type="text" name="productPrice" class="form-control" placeholder="ProductPrice"
                    value="{{ $product->productPrice }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
            <div class="form-group">
                <label>Sizes</label><br>
                @foreach ($sizeMaster as $size)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="size_master_ids[]" value="{{ $size->id }}" {{
                        in_array($size->id, $selectedSizes) ? 'checked' : '' }}>
                    <label class="form-check-label">{{ $size->size }}</label>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
            <div class="form-group">
                <strong>Thumbnail:</strong>
                @if ($product->productThumbnail)
                <img src="{{ asset('collection/product/thumbnail/' . $product->productThumbnail) }}" width="100"><br>
                @endif
                <input type="file" name="productThumbnail" class="form-control mt-2">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
            <div class="form-group">
                <strong>Additional Images:</strong>
                <input type="file" name="productImages[]" multiple class="form-control mb-2">
                @if ($product->images && $product->images->count())
                <div class="d-flex flex-wrap gap-2">
                    @foreach ($product->images as $image)
                    <div style="position: relative; text-align: center;">
                        <img src="{{ asset('collection/product/productimage/' . $image->image) }}" width="100"
                            height="100"
                            style="object-fit:cover; border: 1px solid #ccc; padding: 2px; border-radius: 5px;">
                        <a href="javascript:void(0);" 
                            onclick="deleteImage({{ $image->id }})"
                            style="color: red; font-size: 20px; display: block; margin-top: 5px;">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </div>
                    @endforeach
                </div>
                @else
                <small class="text-muted">No additional images uploaded.</small>
                @endif
            </div>
        </div>

        <div class="col-sm-12 col-lg-10 col-md-12 mt-2">
            <div class="form-check form-check-inline">
                <input type="checkbox" name="status" {{ $product->status == 'Y' ? 'checked' : '' }}>
                <label class="form-check-label" for="status">Is Published</label>
            </div>
        </div>
        <div class="col-sm-12 col-lg-10 col-md-12 mt-2">
            <div class="form-check form-check-inline">
                <input type="checkbox" name="bestseller" {{ $product->bestseller == 'Y' ? 'checked' : '' }}>
                <label class="form-check-label" for="bestseller">Is Trending</label>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary btn-sm mt-2 mb-3"><i class="fa-solid fa-floppy-disk"></i>
                Submit</button>
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {

    $("#productName").blur(function() {
                let productName = $("#productName").val().toLowerCase();
                new1 = productName.replace(/\s+/g, '-').replace(/-+/g, '-').replace(/[^a-zA-Z0-9-]/g, '');
                productName1 = new1.replace(/^-*|-*$|(-)-*/g, "$1");
                $("#slug").val(productName1);
            });
}); 
</script>
<script>
    function deleteImage(imageId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This image will be permanently deleted.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to delete route
                window.location.href = `/product/image/delete/${imageId}`;
            }
        });
    }
</script>

@endsection