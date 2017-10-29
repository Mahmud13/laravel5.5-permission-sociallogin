<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('permissions.index', ['permissions' => $permissions]);
    }

    public function create()
    {
        return view('permissions.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'guard_name' => 'required',
            'category' => 'required',
        ], ['name.required'=>'The Name field is required',
            'guard_name.required'=>'The Guard Name field is required',
            'category.required'=>'The Category Name field is required',]);

        Permission::create($request->all());

        return redirect('permissions')->with('success', 'Permission saved Successfully');
    }

    public function edit($id)
    {
        $permission = Permission::where('id', $id)->first();
        return view('permissions.edit', ['permission' => $permission]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'guard_name' => 'required',
            'category' => 'required',
        ], ['name.required'=>'The Name field is required',
            'guard_name.required'=>'The Guard Name field is required',
            'category.required'=>'The Category Name field is required',]);

        $permission = Permission::find($id);
        $permission->update($request->all());
        return redirect('permissions')->with('success', 'Permission updated Successfully');
    }

    public function destroy($id)
    {
        $permission = Permission::find($id);
        $permission->delete();
        return redirect('permissions')->with('success', 'Permission deleted Successfully');
    }
}
