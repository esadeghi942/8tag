<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Worktime;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class WorktimeController extends Controller
{
    public function index()
    {
        $worktimes=Worktime::all();
        return view('admin.worktime.list',compact('worktimes'));
    }

}
