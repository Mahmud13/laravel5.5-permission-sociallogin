<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Permission;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function indexData(Datatables $datatables)
    {
        return $datatables->eloquent(User::select('users.*'))
                        ->addColumn('action', function ($user) {
                            return view('users.users-action', ['user' => $user]);
                        })
                        ->addColumn('created', function ($user) {
                            return $user->created_at->toFormattedDateString();
                        })
                        ->addColumn('updated', function ($user) {
                            return $user->updated_at->toFormattedDateString();
                        })
                        ->rawColumns(['name', 'action'])
                        ->make(true);
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        $permissions = Permission::all();
        return view('users.edit', ['user' => $user, 'roles' => $roles, 'permissions' => $permissions]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => '',
            'confirm_password' => 'same:password'
        ], ['name.required'=>'The Name field is required',
            'email.required'=>'The Email field is required']);
        $inputs = $request->all();

        $user = User::find($id);


        if (empty($request->input('password'))) {
            $user->update($request->except('password'));
        } else {
            $user->update(
                    ['name'=> $request->name,
                        'email' => $request->email,
                        'password' => bcrypt($request->password),
                    ]
            );
        }


        return redirect('users')->with('success', 'User Info Updated Successfully');
    }
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('users')->with('success', 'User deleted Successfully');
    }


    public function table()
    {
        $users = User::orderBy('users.name', 'asc')
        ->select('users.*')
        ->get();
        $roles = Role::where('name', '!=', 'Super Administrator')
        ->orderBy('name', 'asc')
        ->get();

        return view('users.table', ['roles' => $roles, 'users' => $users]);
    }

    public function tableUpdate(Request $request)
    {
        $role = Role::find($request->input('role_id'));
        $user = User::find($request->input('user_id'));
        if ($request->input('user_role') == 0) {
            $user->removeRole($role);
        } else {
            $user->assignRole($role);
        }
    }
}
