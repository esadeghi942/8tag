<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Leavement;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $prosessing=Leavement::where('status',0)->get()->count();
        $count=User::all()->count();
        return view('admin.index',compact('prosessing','count'));
    }
}
