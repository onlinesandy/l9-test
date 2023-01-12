<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    function __construct()
    {
        //  $this->middleware('permission:permission-list|permission-create|permission-edit|permission-delete', ['only' => ['index','show']]);
        //  $this->middleware('permission:permission-create', ['only' => ['create','store']]);
        //  $this->middleware('permission:permission-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $permissionList = Permission::paginate(Config('constants.paginate_per_page'));
        return view('permissions.index', [
            'title' => 'Permission',
            'breadcrumb' => 'Permission List',
            'help_url' => '/help',
            'permissionList' => $permissionList,
        ]);
    }

    public function addPermission(Request $request)
    {
        $msg = '';
        $id = $request->input('id');
        $validated = $request->validate([
            'name' => 'required|unique:permissions,name,' . $id . '|max:255',
        ]);
        if ($id > 0) {
            permission::whereId($id)->update(['name' => $request->input('name')]);
            $msg = 'Permission Updated Successfully!!!!';
        } else {
            permission::create(['name' => $request->input('name')]);
            $msg = 'Permission Added Successfully!!!!';
        }

        return back()->with(['success' => $msg]);
    }

    public function deletePermission(Request $request)
    {
        $msg = '';
        $id = $request->input('id');
        $validated = $request->validate([
            'id' => 'required',
        ]);
        if ($id > 0) {
            $p = permission::find($id);
            $p->delete();
            $msg = 'Permission Deleted Successfully!!!!';
        }

        return back()->with(['success' => $msg]);
    }
}
