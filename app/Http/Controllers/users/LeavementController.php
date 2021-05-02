<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeavementRequest;
use App\Models\Leavement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\Jalalian;
use Yajra\DataTables\Facades\DataTables;

class LeavementController extends Controller
{
    public function index()
    {
        return view('user.leavement.index');
    }

    public function create()
    {
        return view('user.leavement.create');
    }

    public function store(LeavementRequest $request)
    {
        $date = Jalalian::now()->format('%Y/%m/%d  %H:i:00');
        $request->validated();
        $user=Auth::id();
       Leavement::create([
            'type' => intval($request->type),
            'date_request' => $date,
            'status' => 0,
            'start' => $request->start,
            'finish' => $request->finish,
            'date_count' => intval($request->date_count),
            'description' => $request->description,
            'user_id' => $user
        ]);
        return redirect()->route('user.leavement.index')->with('success', 'مرخصی جدید با موفقیت ثبت گردید.');

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        if ($id && ctype_digit($id)) {
            $leavementItem = Leavement::find($id);
            if ($leavementItem && $leavementItem instanceof Leavement) {
                return view('user.leavement.edit', compact('leavementItem'));
            }
        }
    }

    public function update(LeavementRequest $request, $id)
    {
        $date = Jalalian::now()->format('%Y/%m/%d  %H:i:00');
        $request->validated();
        $leavement=Leavement::find($id);
        $inputs = [
            'type' => intval($request->type),
            'date_request' => $date,
            'status' => 0,
            'start' => $request->start,
            'finish' => $request->finish,
            'date_count' => intval($request->date_count),
            'description' => $request->description,
        ];
        $update = $leavement->update($inputs);
        if ($update) {
            return redirect()->route('user.leavement.index')->with('success', 'درخواست مرخصی با موفقیت به روز رسانی شد.');
        }
    }

    public function destroy(Request $request,$leavement_id)
    {
        if ($request->ajax() && $leavement_id && ctype_digit($leavement_id)) {
            $leavementItem=Leavement::find($leavement_id);
            if ($leavementItem && $leavementItem instanceof Leavement && $leavementItem->user_id == Auth::id()) {
                $leavementItem->delete();
                return response('success');
            }
            return response('error');
        }
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $user_id=Auth::id();
            $data = Leavement::where('user_id',$user_id)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function(Leavement $leavement){
                    $actionBtn = '<a href="'.route('user.leavement.edit',$leavement->id).'" class="edit btn btn-success btn-sm">ویرایش</a>
                                  <a data-id="'.$leavement->id.'" class="delete btn btn-danger btn-sm">حذف</a>';
                    return $actionBtn;
                })->
                editColumn('type',function ($row){
                    if($row->type=='1')
                        return 'روزانه';
                    else if($row->type=='2')
                        return 'ساعتی';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

}
