@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="card shadow-sm  bg-body rounded">
            <div class="card-header ">
                <div class="row">
                    <div class="col">
                        <h6>Show Permission</h6>
                    </div>
                    <div class="col" align="right">
                        <a class="btn btn-primary" href="{{ route('permission.index') }}"> Back</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $permission->name }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Guard Name:</strong>
                            {{ $permission->guard_name }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
