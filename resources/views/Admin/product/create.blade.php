@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create New Product</h2>
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

<form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="productName" placeholder="ProductName" id="productName" class="form-control"
                    value="{{ old('productName') }}">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
            <div class="form-group">
                <strong>Slug:</strong>
                <input type="text" name="slug" placeholder="Slug" id="slug" class="form-control"
                    value="{{ old('slug') }}">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
            <div class="form-group">
                <strong>Description:</strong>
                <textarea name="productDescription" id="productDescription" placeholder="ProductDescription"
                    class="form-control" rows="4">{{ old('productDescription') }}</textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
            <div class="form-group">
                <strong>Price:</strong>
                <input type="text" name="productPrice" class="form-control" placeholder="ProductPrice"
                    value="{{ old('productPrice') }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
            <div class="form-group">
                <label><strong>Product Sizes:</strong></label>
                <div class="d-flex gap-2 flex-wrap">
                    @foreach ($sizeMaster as $size)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="size_master_ids[]" value="{{ $size->id }}"
                            id="size_{{ $size->id }}">
                        <label class="form-check-label" for="size_{{ $size->id }}">
                            {{ $size->size }}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
            <div class="form-group">
                <strong>Thumbnail:</strong>
                <input type="file" name="productThumbnail" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
            <div class="form-group">
                <strong>Additional Images:</strong>
                <input type="file" name="productImages[]" class="form-control" multiple>
            </div>
        </div>

        <div class="col-sm-12 col-lg-10 col-md-12 mt-2">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="status" value="Y" name="status">
                <label class="form-check-label" for="status">Is Published</label>
            </div>
        </div>
        <div class="col-sm-12 col-lg-10 col-md-12 mt-2">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="bestseller" value="N" name="bestseller">
                <label class="form-check-label" for="status">Is Trending</label>
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
@endsection