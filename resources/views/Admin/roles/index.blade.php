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
            Role Management
        </div>
        @can('role-create')
        <a class="btn btn-success btn-sm mb-2" href="{{ route('roles.create') }}"><i class="fa fa-plus"></i>
            Role</a>
        @endcan
    </div>

    <div class="card-body">

        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th width="100px">No</th>
                    <th>Name</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($roles as $key => $role)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{ route('roles.show',$role->id) }}"><i
                                class="fa-solid fa-list"></i>
                            Show</a>
                        @can('role-edit')
                        <a class="btn btn-primary btn-sm" href="{{ route('roles.edit',$role->id) }}"><i
                                class="fa-solid fa-pen-to-square"></i> Edit</a>
                        @endcan

                        @can('role-delete')
                        <form method="POST" action="{{ route('roles.destroy', $role->id) }}" style="display:inline">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i>
                                Delete</button>
                        </form>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
{{-- {!! $roles->links('pagination::bootstrap-5') !!} --}}

{{-- <p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p> --}}
@endsection