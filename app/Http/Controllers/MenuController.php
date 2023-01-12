<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Icons;


class MenuController extends Controller
{
    function __construct()
    {
        //  $this->middleware('permission:menu-list|menu-create|menu-edit|menu-delete', ['only' => ['index','show']]);
        //  $this->middleware('permission:menu-create', ['only' => ['create','store']]);
        //  $this->middleware('permission:menu-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:menu-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $iconsArr = Icons::where('status','1')->pluck('name')->toArray();
        return view('menu.index',[
            'title'=>'Menu',
            'breadcrumb'=>'Menu List',
            'help_url'=>'/help',
            'iconsArr'=>$iconsArr,
        ]);
    }
}
