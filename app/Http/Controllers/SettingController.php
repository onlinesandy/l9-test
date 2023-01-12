<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(){
        return view('settings.index',[
            'title'=>'Setting',
            'breadcrumb'=>'Setting List',
            'help_url'=>'/help',
        ]);
    }
}
