<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Leavement;
use Illuminate\Http\Request;

class LeavementController extends Controller
{
    public function index()
    {
        $leavements=Leavement::all();
        return view('admin.leavement.list',compact('leavements'));
    }

    public function agree($leavement_id)
    {
        $item=Leavement::find($leavement_id);
        $item->leavement_status=2;
        $item->save();
        $leavements=Leavement::all();
        return view('admin.leavement.list',compact('leavements'));

    }

    public function disagree($leavement_id)
    {
        $item=Leavement::find($leavement_id);
        $item->leavement_status=1;
        $item->save();
        $leavements=Leavement::all();
        return view('admin.leavement.list',compact('leavements'));
    }
}
