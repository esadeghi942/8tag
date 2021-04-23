<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function redirectUser(){
        if (Auth::user()->role == 2)
            return redirect()->route('admin');
        else
            return view('users.index');
    }

    public function reloadCaptcha(){
        return response()->json(['captcha'=> captcha_img()]);
    }

}
