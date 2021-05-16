<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorktimeRequest;
use App\Models\Worktime;
use Carbon\Carbon;
use DateTime;
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
        $dates=[];
        $user_id=Auth::id();
        $worktimes=Worktime::all()->where('user_id',$user_id)->pluck('date')->toArray();

        for($i=0;$i<7;$i++){
            $dd=Jalalian::now()->subDays($i)->format('%A ,%Y/%m/%d');
            if(!in_array($dd,$worktimes))
                $dates[]=$dd;
        }
        return view('user.worktime.create',compact('dates'));
    }

    public function store(WorktimeRequest $request)
    {
        $request->validated();
        $user=Auth::id();
        $dteStart = new DateTime($request->time_start);
        $dteEnd   = new DateTime($request->time_finish);
        $total=$dteStart->diff($dteEnd)->format("%H:%I:%s");
        worktime::create([
            'date' => $request->date,
            'time_start' => $request->time_start,
            'time_finish' => $request->time_finish,
            'reduce' => intval($request->reduce),
            'total' => $total,
            'teleworking' => intval($request->teleworking),
            'description' => $request->description,
            'user_id' => $user
        ]);
        return redirect()->route('user.worktime.index')->with('success', 'ساعت کاری جدید با موفقیت ثبت گردید.');

    }

    public function edit($worktime_id)
    {
        if ($worktime_id && ctype_digit($worktime_id)) {
            $worktimeItem = worktime::find($worktime_id);
            $dates=[];
            for($i=0;$i<7;$i++){
                $dates[]=Jalalian::now()->subDays($i)->format('%A ,%Y/%m/%d');
            }
            if ($worktimeItem && $worktimeItem instanceof worktime) {
                return view('user.worktime.edit', compact('worktimeItem','dates'));
            }
        }
    }

    public function update(WorktimeRequest $request, $worktime_id)
    {
        $request->validated();
        $worktime=Worktime::find($worktime_id);
        /*$tStart=explode(':',$request->time_start);
        $tEnd=explode(':',$request->time_finish);
        $tStart =  Carbon::createFromTime($tStart[0],$tStart[1]);
        $tEnd   =  Carbon::createFromTime($tEnd[0],$tEnd[1]);
        $total=$dteDiff  = $tStart->diffInMinutes($tEnd); */
        $dteStart = new DateTime($request->time_start);
        $dteEnd   = new DateTime($request->time_finish);
        $total = $dteStart->diff($dteEnd)->format("%H:%I:%S");
        $inputs = [
            'date' => $request->date,
            'time_start' => $request->time_start,
            'time_finish' => $request->time_finish,
            'reduce' => intval($request->reduce),
            'total' => $total,
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
                    $actionBtn = '<a href="'.route('user.worktime.edit',$wt->id).'" class="edit btn btn-success btn-sm"><span title="ویرایش" class="fa fa-edit"></span></a>
                                  <a data-id="'.$wt->id.'" class="delete btn btn-danger btn-sm"><span title="حذف" class="fa fa-trash"></span></a>';
                    return $actionBtn;
                })->
                editColumn('total',function ($row){
                    $total =Carbon::createFromFormat('H:i:s',$row->total);
                    return $total->format('H:i');
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
