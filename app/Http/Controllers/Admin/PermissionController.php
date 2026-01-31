<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionController extends Controller
{
        function __construct()
    {
         $this->middleware('permission:permission-list|permission-create|permission-edit|permission-delete', ['only' => ['index','store']]);
         $this->middleware('permission:permission-create', ['only' => ['create','store']]);
         $this->middleware('permission:permission-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $perPage = $request['perPage'] ?? "";

        $permission = Permission::orderBy('id', 'desc');
        if ($perPage) {
            $permission = $permission->paginate($perPage);
        } else {
            $permission = $permission->paginate(10);
        }

        return view('Admin.permission.index', compact('permission', 'perPage'));
    }

    public function create()
    {
        return view('Admin.permission.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'guard_name' => 'required',
        ]);

        $permission = new Permission();
        $name = $request->name;
        $permissionname = str_replace(" ", "-", $name);
        $permission->name = $permissionname;
        $permission->guard_name = $request->guard_name;
        $permission->save();
        return redirect('permission/index')->with('success', "Permission Inserted");
    }

    public function edit($id)
    {
        $permission = Permission::find($id);
        return view('Admin.permission.edit', compact('permission'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'guard_name' => 'required',

        ]);

        $id = $request->permissionid;
        $permission = Permission::find($id);
        $name = $request->name;
        $permissionname = str_replace(" ", "-", $name);
        $permission->name = $permissionname;
        $permission->guard_name = $request->guard_name;
        $permission->save();
        return redirect('permission/index')->with('success', "Permission Updated");
    }

    public function show($id)
    {
        $permission = Permission::find($id);
        return view('Admin.permission.show', compact('permission'));
    }

    public function delete($id)
    {
        $permission = Permission::find($id);
        $permission->delete();
        return redirect('permission/index')->with('success', "Permission Deleted");
    }

}
