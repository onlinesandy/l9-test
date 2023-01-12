<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Hash;
use Illuminate\Validation\Rule;
use App\Notifications\PermissionUpdate;
use App\Exports\UsersExport;
use Notification;
use Excel;


class UserController extends Controller
{
    function __construct()
    {
        //  $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','show']]);
        //  $this->middleware('permission:user-create', ['only' => ['create','store']]);
        //  $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    public function testevent(Request $request)
    {
        event (new \App\Events\Test('test'));

    }

    public function index(Request $request)
    {
        $userList = User::paginate(Config('constants.paginate_per_page'));
        // dd($userList);
        $permissions = Permission::get();
        $roles = Role::orderBy('name')->paginate(Config('constants.paginate_per_page'));


        return view('users.index', [
            'title' => 'User',
            'breadcrumb' => 'Users List',
            'help_url' => '/help',
            'userList' => $userList,
            'roles'=>$roles,
            'permissions'=>$permissions,

        ]);
    }

    public function store(Request $request)
    {
        $msg = '';


        $id = $request->input('user-id');
        $user_roles = $request->input('user-role');
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => [
                'max:255',
                'unique:users,email',
                Rule::when(($id==0), ['required'])
            ],
            'user-role' => 'required',
            'user-permission' => [
                Rule::when((count($user_roles)==0), ['required'])
            ],
        ]);

        if ($id > 0) {
            $row = User::find($id);
            $row->name = $request->input('name');
            $row->save();
            $row->syncRoles($request->input('user-role'));
            $row->syncPermissions($request->input('user-permission'));
            $msg = 'User Updated Successfully';

        } else {
            $row = User::create(
                [
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => Hash::make('12345678')
                ]
            );
            $row->assignRole($request->input('user-role'));
            $row->givePermissionTo($request->input('user-permission'));
            $msg = 'User Created Successfully';

        }

        Notification::send($row, new PermissionUpdate($row));
        // event (new \App\Events\Test($row));
        return redirect()
                ->route('users.index')
                ->with('success', $msg);
    }
    public function deleteUser(Request $request)
    {
        $msg = '';
        $id = $request->input('id');
        $validated = $request->validate([
            'id' => 'required',
        ]);
        if ($id > 0) {
            $row = User::find($id);
            $row->delete();
            $msg = 'User Deleted Successfully!!!!';
        }

        return back()->with(['success' => $msg]);
    }

    public function userexport()
    {
        return Excel::download(new UsersExport, 'users-collection.xlsx');
    }

}
