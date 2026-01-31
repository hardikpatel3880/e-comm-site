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
            Permission Management
        </div>
        <a class="btn btn-success" href="{{ route('permission.create') }}"><i class="fa fa-plus"></i> Permission</a>
    </div>

    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Guard Name</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>

                @if (count($permission) > 0)
                @foreach ($permission as $key => $permission1)
                <tr>
                    <td>{{ $permission->firstItem() + $key }}</td>
                    <td>
                        <?php
                                    $name = $permission1->name;
                                    $permissionname = str_replace('-', ' ', $name);
                                    ?>
                        {{ $permissionname }}
                    </td>
                    <td>{{ $permission1->guard_name }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('permission.edit') }}/{{ $permission1->id }}">Edit</a>
                        <a class="btn btn-danger"
                            href="{{ route('permission.delete') }}/{{ $permission1->id }} ">Delete</a>
                        <a class="btn btn-info" href="{{ route('permission.show', $permission1->id) }}">Show</a>

                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="4" align="center" style="color: red;">
                        <h3>No Data Record Found</h3>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
        {{-- {!! $permission->withQueryString()->links('pagination::bootstrap-5') !!} --}}
    </div>
</div>
@endsection