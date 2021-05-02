<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorktimeRequest;
use App\Models\Worktime;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\Jalalian;
use Yajra\DataTables\Facades\DataTables;


class WorktimeController extends Controller
{
    public function index()
    {
        return view('user.worktime.index');
    }

    public function create()
    {
        return view('user.worktime.create');
    }

    public function store(WorktimeRequest $request)
    {
        $request->validated();
        $user=Auth::id();
        worktime::create([
            'date' => $request->date,
            'time_start' => $request->time_start,
            'time_finish' => $request->time_finish,
            'reduce' => intval($request->reduce),
            'total' => intval($request->total),
            'teleworking' => intval($request->teleworking),
            'description' => $request->description,
            'user_id' => $user
        ]);
        return redirect()->route('user.worktime.index')->with('success', 'ساعت کاری جدید با موفقیت ثبت گردید.');

    }

    public function show($id)
    {
        //
    }

    public function edit($worktime_id)
    {
        if ($worktime_id && ctype_digit($worktime_id)) {
            $worktimeItem = worktime::find($worktime_id);
            if ($worktimeItem && $worktimeItem instanceof worktime) {
                return view('user.worktime.edit', compact('worktimeItem'));
            }
        }
    }

    public function update(WorktimeRequest $request, $worktime_id)
    {
        $request->validated();
        $worktime=Worktime::find($worktime_id);
        $inputs = [
            'date' => $request->date,
            'time_start' => $request->time_start,
            'time_finish' => $request->time_finish,
            'reduce' => intval($request->reduce),
            'total' => intval($request->total),
            'teleworking' => intval($request->teleworking),
            'description' => $request->description,
        ];
        $update = $worktime->update($inputs);
        if ($update) {
            return redirect()->route('user.worktime.index')->with('success', 'ساعت کاری با موفقیت به روز رسانی شد.');
        }
    }

    public function destroy(Request $request,$worktime_id)
    {
        if ($request->ajax() && $worktime_id && ctype_digit($worktime_id)) {
            $worktimeItem=Worktime::find($worktime_id);
            if ($worktimeItem && $worktimeItem instanceof Worktime && $worktimeItem->user_id == Auth::id()) {
                $worktimeItem->delete();
                return response('success');
            }
            return response('error');
        }
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $user_id=Auth::id();
            $data = Worktime::where('user_id',$user_id)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function(Worktime $wt){
                    $actionBtn = '<a href="'.route('user.worktime.edit',$wt->id).'" class="edit btn btn-success btn-sm">ویرایش</a>
                                  <a data-id="'.$wt->id.'" class="delete btn btn-danger btn-sm">حذف</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
