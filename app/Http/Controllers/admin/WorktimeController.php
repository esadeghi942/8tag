<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Worktime;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class WorktimeController extends Controller
{
    public function index($user_id)
    {
        return view('admin.worktime.index',compact('user_id'));
    }

    public function data(Request $request,$user_id)
    {
        if ($request->ajax()) {
            $data = Worktime::where('user_id',$user_id)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->rawColumns([])
                ->make(true);
        }
    }
}
