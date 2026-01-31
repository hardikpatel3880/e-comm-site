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

    <form method="POST" action="{{ route('slider.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>SortOrder:</strong>
                    <input type="text" name="sortOrder" placeholder="Position" id="sortOrder" class="form-control"
                        value="{{ old('sortOrder') }}">
                </div>
            </div>

            {{-- <div class="col-xs-12 col-sm-12 col-md-12 mt-2"> --}}
            <div class="col-sm-12 col-lg-2 col-md-12 mt-4">
                <strong>Image:</strong>

                <img src="{{ asset('defaultimage/default4.jpg') }}" alt="{{ __('main image') }}" id="img1"
                    height="100px" style="box-shadow: 2px 2px;">
            </div>
            <div class="col-sm-12 col-lg-10 col-md-12 mt-4">
                <div class="row">
                    <div class="col-lg-8 mt-2">
                        <input type="file" class="form-control" id="image" onchange="readURL(this,'#img1')"
                            accept="image/*" name="image" value="">
                    </div>
                </div>
            </div>
            {{-- <div class="form-group">
                <strong>Image:</strong>
                <input type="file" name="image" class="form-control">
            </div> --}}
            {{--
        </div> --}}
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary btn-sm mt-2 mb-3"><i class="fa-solid fa-floppy-disk"></i>
                    Submit</button>
            </div>
        </div>
    </form>
    <script>
        function readURL(input, tgt) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector(tgt).setAttribute("src", e.target.result);

                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
