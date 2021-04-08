<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\Leavement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\Jalalian;

class LeavementController extends Controller
{
    public function index()
    {
        $user=User::find(Auth::id());
        $leavements=$user->leavements()->get();
        return view('users.leavement.list',compact('leavements'));
    }

    public function create()
    {
        return view('users.leavement.add');
    }


    public function store(Request $request)
    {
        $date = Jalalian::now()->format('%Y/%m/%d  %H:i:00');
        $request->validate([
            'leavement_type'=>'string|required',
            'leavement_start'=>'string|required',
            'leavement_finish'=>'string|required',
            'leavement_date_count'=>'numeric|required',
            'leavement_description'=>'string|required'
        ]);
        $user=Auth::id();
       Leavement::create([
            'leavement_type' => intval($request->leavement_type),
            'leavement_date_request' => $date,
            'leavement_status' => 0,
            'leavement_start' => $request->leavement_start,
            'leavement_finish' => $request->leavement_finish,
            'leavement_date_count' => intval($request->leavement_date_count),
            'leavement_description' => $request->leavement_description,
            'user_id' => $user
        ]);
        return redirect()->route('user.leavement')->with('success', 'مرخصی جدید با موفقیت ثبت گردید.');

    }

    public function show($id)
    {
        //
    }

    public function edit($leavement_id)
    {
        if ($leavement_id && ctype_digit($leavement_id)) {
            $leavementItem = Leavement::find($leavement_id);
            if ($leavementItem && $leavementItem instanceof Leavement) {
                return view('users.leavement.edit', compact('leavementItem'));
            }
        }
    }

    public function update(Request $request, $leavement_id)
    {
        $date = Jalalian::now()->format('%Y/%m/%d  %H:i:00');
        $request->validate([
            'leavement_type'=>'string|required',
            'leavement_start'=>'string|required',
            'leavement_finish'=>'string|required',
            'leavement_date_count'=>'numeric|required',
            'leavement_description'=>'string|required'
        ]);
        $leavement=Leavement::find($leavement_id);
        $inputs = [
            'leavement_type' => intval($request->leavement_type),
            'leavement_date_request' => $date,
            'leavement_status' => 0,
            'leavement_start' => $request->leavement_start,
            'leavement_finish' => $request->leavement_finish,
            'leavement_date_count' => intval($request->leavement_date_count),
            'leavement_description' => $request->leavement_description,
        ];
        $update = $leavement->update($inputs);
        if ($update) {
            return redirect()->route('user.leavement')->with('success', 'درخواست مرخصی با موفقیت به روز رسانی شد.');
        }
    }

    public function delete($leavement_id)
    {
        if ($leavement_id && ctype_digit($leavement_id)) {
            $leavementItem=Leavement::find($leavement_id);
            if ($leavementItem && $leavementItem instanceof Leavement && $leavementItem->user_id == Auth::id()) {
                $leavementItem->delete();
                return redirect()->route('user.leavement')->with('success', 'درخواست مرخصی مورد نظر با موفقیت حذف گردید.');
            }
            return redirect()->route('user.leavement')->with('danger', 'حذف درخواست مرخصی ممکن نیست.');
        }
    }
}
