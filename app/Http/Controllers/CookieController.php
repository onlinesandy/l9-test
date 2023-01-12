<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cookie;

class CookieController extends Controller
{
    public function setPrivacyPolicyCookie(Request $request)
    {
        Cookie::queue('privacy-policy-cookie', 'privacy-policy-cookie-val', 26 * 60);
        return redirect()->back();
    }
}
