@extends('layouts.app')
@section('content')
   
    <div class="card shadow-sm  bg-body rounded">
        <div class="card-header ">
            <div class="row">
                <div class="col">
                    <h6>Edit Permission</h6>
                </div>
                <div class="col" align="right">
                    <button class="btn btn-primary" type="button" onclick="javascript:history.go(-1)"> Back </button>
                </div>
            </div>
        </div>
        <div class="card-body">

            <form action="{{ route('permission.update') }}" method="post">
                @csrf
                <div class="row">
                    <input type="hidden" value="{{ $permission->id }}" name="permissionid">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="name" placeholder="Name" name="name"
                                value="{{ $permission->name }}">
                            <label for="name">Name</label>
                        </div>
                        <span class="text-danger">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="guard_name" placeholder="Guard Name"
                                name="guard_name" value="{{ $permission->guard_name }}">
                            <label for="name">Guard Name</label>
                        </div>
                        <span class="text-danger">
                            @error('guard_name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button class="btn btn-secondary" type="button" onclick="javascript:history.go(-1)"> Cancel </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
