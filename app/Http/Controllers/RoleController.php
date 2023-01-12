<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class RoleController extends Controller
{
    function __construct()
    {
        //  $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
        //  $this->middleware('permission:role-create', ['only' => ['create','store']]);
        //  $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {

        $permissions = Permission::get();

        // $viewUrl = 'roles.my-role';
        $viewUrl = 'roles.index';
        if(auth()->user()->hasRole('Super Admin')){
            $roles = Role::orderBy('name')->paginate(Config('constants.paginate_per_page'));
            $viewUrl = 'roles.index';
        }else{
            $roles = auth()->user()->roles;
        }
        return view($viewUrl, [
            'title' => 'Roles',
            'breadcrumb' => 'Role List',
            'help_url' => '/help',
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        if ($request->input('id') > 0) {
            $role = Role::find($id);
            $role->name = $request->input('name');
            $role->save();

            $role->syncPermissions($request->input('permission'));

            return redirect()
                ->route('roles.index')
                ->with('success', 'Role updated successfully');
        } else {
            $role = Role::create(['name' => $request->input('name')]);
            $role->syncPermissions($request->input('permission'));

            return redirect()
                ->route('roles.index')
                ->with('success', 'Role created successfully');
        }
    }


    public function destroy(Request $request)
    {
        $msg = '';
        $id = $request->input('id');
        $validated = $request->validate([
            'id' => 'required',
        ]);
        if ($id > 0) {
            $r = Role::find($id);
            $r->delete();
            $msg = 'Role Deleted Successfully!!!!';
        }
        return redirect()
            ->route('roles.index')
            ->with('success', $msg);
    }
}
