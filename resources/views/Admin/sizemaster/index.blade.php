@extends('layouts.app')

@section('content')

@session('success')
<div class="alert alert-success" role="alert">
    {{ $value }}
</div>
@endsession
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <i class="fas fa-table me-1"></i>
            SizeMaster Management
        </div>
        <a class="btn btn-success mb-2" href="{{ route('productSizeMaster.create') }}"><i class="fa fa-plus"></i>
            Size</a>

    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Size</th>
                    <th>Status</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sizeMaster as $index => $size)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $size->size }}</td>
                    <td>
                        @if($size->status == "Y")
                        {{ "Active"  }}
                        @else
                        {{'Inactive'}}
                        @endif
                    <td>
                        <a class="btn btn-sm btn-warning" href="{{ route('productSizeMaster.edit', $size->id) }}"><i
                                class="fa fa-edit"></i></a>
                        <a class="btn btn-sm btn-danger" href="{{route('productSizeMaster.delete', $size->id)}}"><i
                                class="fa fa-trash"></i></a>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection