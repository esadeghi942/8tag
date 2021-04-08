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

    }

    public function disagree($leavement_id)
    {

    }
}
