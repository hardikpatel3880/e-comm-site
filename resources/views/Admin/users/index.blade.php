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
            Users Management
        </div>
        <a class="btn btn-success mb-2" href="{{ route('users.create') }}"><i class="fa fa-plus"></i> 
            User</a>

    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($data as $key => $user)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if (!empty($user->getRoleNames()))
                        @foreach ($user->getRoleNames() as $v)
                        <label class="badge badge-success" style="color:white; background-color:red;">{{ $v }}</label>
                        @endforeach
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{ route('users.show',$user->id) }}"><i
                                class="fa-solid fa-list"></i>
                            Show</a>
                        <a class="btn btn-primary btn-sm" href="{{ route('users.edit',$user->id) }}"><i
                                class="fa-solid fa-pen-to-square"></i> Edit</a>
                        <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display:inline">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i>
                                Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
{{-- {!! $data->links('pagination::bootstrap-5') !!} --}}

{{-- <p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p> --}}

@endsection