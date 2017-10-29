<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;
use App\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::where('name', '!=', 'Super Administrator')->get();

        return view('roles.index', ['roles' => $roles]);
    }

    public function create()
    {
        $permissions = Permission::all();

        return view('roles.create', ['permissions' => $permissions]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'guard_name' => 'required',
                ], ['name.required' => 'The Role Name field is required',
            'guard_name.required' => 'The Guard Name field is required']);

        $role = Role::create($request->all());
        $permissions = $request->input('permissions');
        if (isset($permissions)) {
            foreach ($permissions as $permission) {
                $role->givePermissionTo($permission);
            }
        }
        return redirect('roles')->with('success', 'Role saved Successfully');
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::all();
        return view('roles.edit', ["role" => $role, 'permissions' => $permissions]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'guard_name' => 'required',
                ], ['name.required' => 'The Role Name field is required',
            'guard_name.required' => 'The Guard Name field is required']);

        $role = Role::find($id);
        $role->update($request->all());


        if (!empty($request->input('permissions'))) {
            $role->syncPermissions($request->input('permissions'));
        }

        return redirect('roles')->with('success', 'Roles updated Successfully');
    }

    public function table()
    {
        $roles = Role::orderBy('name', 'asc')
            ->where('name', '!=', 'Super Administrator')
            ->get();
        $perm_groups = Permission::orderBy('category', 'asc')
                ->orderBy('name', 'asc')
                ->where('category', '<>', 'Permission')
                ->get()
                ->groupBy('category');



        return view('roles.table', ['roles' => $roles, 'perm_groups' => $perm_groups]);
    }

    public function tableUpdate(Request $request)
    {
        $role = Role::find($request->input('role_id'));
        $permission = Permission::find($request->input('perm_id'));

        if ($request->input('role_perm') == 0) {
            $role->revokePermissionTo($permission);
        } else {
            $role->givePermissionTo($permission);
        }
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();

        return redirect('roles')->with('success', 'Role deleted Successfully');
    }
}
