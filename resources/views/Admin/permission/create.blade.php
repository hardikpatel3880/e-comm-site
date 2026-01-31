@extends('layouts.app')
@section('content')
   
    <div class="card shadow-sm  bg-body rounded">
        <div class="card-header ">
            <div class="row">
                <div class="col">
                    <h6>Create New Permission</h6>
                </div>
                <div class="col" align="right">
                    <button class="btn btn-primary" type="button" onclick="javascript:history.go(-1)"> Back </button>
                </div>
            </div>
        </div>
        <div class="card-body">

            <form action="{{ route('permission.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="name" placeholder="Name" name="name"
                                value="{{ old('name') }}">
                            <label for="name">Name</label>
                        </div>
                        <span class="text-danger">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="">Guard Name</label>
                                <select class="form-select" aria-label="Default select example" name="guard_name"
                                    id="guard_name">
                                    {{-- <option selected disabled>--Select Guard Name--</option> --}}
                                    <option value="web" selected {{ old('guard_name') == 'web' ? 'selected' : '' }}>web
                                    </option>
                                    <option value="mobile" {{ old('guard_name') == 'mobile' ? 'selected' : '' }}>Mobile
                                    </option>
                                </select>
                            </div>
                            <span class="text-danger">
                                @error('guard_name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button class="btn btn-secondary" type="button" onclick="javascript:history.go(-1)"> Cancel </button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
@endsection
