@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create New Product</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary btn-sm mb-2" href="{{ route('productSizeMaster.index') }}"><i class="fa fa-arrow-left"></i>
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

<form method="POST" action="{{ route('productSizeMaster.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Size:</strong>
                <input type="text" name="size" placeholder="Size"  class="form-control"
                    value="{{ old('size') }}">
            </div>
        </div>

        <div class="col-sm-12 col-lg-10 col-md-12 mt-2">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="status" value="Y" name="status">
                <label class="form-check-label" for="status">Is Published</label>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary btn-sm mt-2 mb-3"><i class="fa-solid fa-floppy-disk"></i>
                Submit</button>
        </div>
    </div>
</form>

@endsection