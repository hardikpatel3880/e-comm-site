@extends('layouts.app')

@section('content')
<style>
        @media (max-width: 576px) {

        #img1 {
            width: 250px;
            /* max-width: 300px; */
            /* Limit width on mobile */
            height: 100%;
            /* Maintain aspect ratio */
        }
    }

</style>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Update Slider</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary btn-sm mb-2" href="{{ route('slider.index') }}"><i class="fa fa-arrow-left"></i>
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

<form method="POST" action="{{ route('slider.update', $slider->id) }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>SortOrder:</strong>
                <input type="text" name="sortOrder" placeholder="sortOrder" id="sortOrder" class="form-control"
                    value="{{ $slider->sortOrder }}">
            </div>
        </div>
        <div class="row mt-4 mb-4">
            <div class="col-sm-12 col-lg-2 col-md-12">
                <strong>Image:</strong>

                <img src="{{ url('collection/slider/image/' . $slider->image) }}" alt="{{ __('main image') }}" id="img1"
                    height="100%" width="300px" style="box-shadow: 2px 2px;">
            </div>

        </div>
        <div class="col-sm-12 col-lg-10 col-md-12">
            <div class="row">
                <div class="col-lg-8 mt-2">
                    <input type="file" class="form-control" id="image" onchange="readURL(this,'#img1')" accept="image/*"
                        name="image" value="{{ $slider->image }}">
                </div>
            </div>
        </div>
        {{-- <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
            <div class="form-group">
                <strong>Image:</strong>
                @if ($slider->image)
                <img src="{{ asset('collection/slider/image/' . $slider->image) }}" width="50%"><br>
                @endif
                <input type="file" name="image" class="form-control mt-2">
            </div>
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