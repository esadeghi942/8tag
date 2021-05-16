<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeavementRequest;
use App\Models\Leavement;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\Jalalian;
use Yajra\DataTables\Facades\DataTables;
use DateTime;

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
        $request->date = english_digits($request->date);
        if ($request->type == 2) {
            $_date = english_digits($request->date);
            $_date = Jalalian::fromFormat('Y/m/d', $_date);
            if ($_date->isPast())
                return redirect()->back()->withErrors('تاریخ درخواست نامعتبر است');
            $start = new DateTime($request->time_start);
            $finish = new DateTime($request->time_finish);
            $count = $start->diff($finish);
            $start = $start->format('H:i');
            $finish = $finish->format('H:i');
            $count = $count->format('%H:%I:%S');
        } elseif ($request->type == 1) {
            $start = english_digits($request->start);
            $finish = english_digits($request->finish);
            $_start = Jalalian::fromFormat('Y/m/d', $start);
            $_finish = Jalalian::fromFormat('Y/m/d', $finish);
            if ($_start->isPast())
                return redirect()->back()->withErrors('تاریخ درخواست نامعتبر است');
            elseif ($_finish->lessThanOrEqualsTo($_start))
                return redirect()->back()->withErrors('تاریخ پایان از تاریخ شروع کمتر است');
            $_start = $_start->toCarbon();
            $_finish = $_finish->toCarbon();
            $_finish->diff($_start)->days;
            $count = $_finish->diff($_start)->days;
            $count *= 8;
            $count = $count . ':00:00';
        }
        $user = Auth::id();
        $inputs=[
            'type' => intval($request->type),
            'date_request' => $date,
            'status' => 0,
            'start' => $start,
            'finish' => $finish,
            'date_count' => $count,
            'description' => $request->description,
            'user_id' => $user
        ];
        if ($request->type == 2)
            $inputs['date'] = $request->date;
        else
            $inputs['date'] = $start;
        Leavement::create($inputs);
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
        $request->date = english_digits($request->date);
        if ($request->type == 2) {
            $_date = english_digits($request->date);
            $_date = Jalalian::fromFormat('Y/m/d', $_date);
            if ($_date->isPast())
                return redirect()->back()->withErrors('تاریخ درخواست نامعتبر است');
            $start = new DateTime($request->time_start);
            $finish = new DateTime($request->time_finish);
            $count = $start->diff($finish);
            $start = $start->format('H:i');
            $finish = $finish->format('H:i');
            $count = $count->format('%H:%I:%S');
        } elseif ($request->type == 1) {
            $start = english_digits($request->start);
            $finish = english_digits($request->finish);
            $_start = Jalalian::fromFormat('Y/m/d', $start);
            $_finish = Jalalian::fromFormat('Y/m/d', $finish);
            if ($_start->isPast())
                return redirect()->back()->withErrors('زمان درخواست نامعتبر است');
            elseif ($_finish->lessThanOrEqualsTo($_start))
                return redirect()->back()->withErrors('تاریخ پایان از تاریخ شروع کمتر است');
            $_start = $_start->toCarbon();
            $_finish = $_finish->toCarbon();
            $_finish->diff($_start)->days;
            $count = $_finish->diff($_start)->days;
            $count *= 8;
            $count = $count . ':00:00';
        }
        $leavement = Leavement::find($id);
        $inputs = [
            'type' => intval($request->type),
            'date_request' => $date,
            'status' => 0,
            'start' => $start,
            'finish' => $finish,
            'date_count' => $count,
            'description' => $request->description,
        ];
        if ($request->type == 2)
            $inputs['date'] = $request->date;
        else
            $inputs['date'] = $start;
        $update = $leavement->update($inputs);
        if ($update) {
            return redirect()->route('user.leavement.index')->with('success', 'درخواست مرخصی با موفقیت به روز رسانی شد.');
        }
    }

    public function destroy(Request $request, $leavement_id)
    {
        if ($request->ajax() && $leavement_id && ctype_digit($leavement_id)) {
            $leavementItem = Leavement::find($leavement_id);
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
            $user_id = Auth::id();
            $data = Leavement::where('user_id', $user_id)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function (Leavement $leavement) {
                    $actionBtn = '<a href="' . route('user.leavement.edit', $leavement->id) . '" class="edit btn btn-success btn-sm"><span title="ویرایش" class="fa fa-edit"></span></a>
                                  <a data-id="' . $leavement->id . '" class="delete btn btn-danger btn-sm"><span title="حذف" class="fa fa-trash"></span></a>';
                    if ($leavement->status == 0)
                        return $actionBtn;
                })->
                editColumn('type', function ($row) {
                    if ($row->type == '1')
                        return 'روزانه';
                    else if ($row->type == '2')
                        return 'ساعتی';
                })->
                editColumn('start', function ($row) {
                    if ($row->type == 2)
                        return $row->start . ' - ' . $row->date;
                    else
                        return $row->start;
                })->
                editColumn('finish', function ($row) {
                    if ($row->type == 2)
                        return $row->finish . ' - ' . $row->date;
                    return $row->finish;
                })
                ->
                editColumn('date_count', function ($row) {
                    return date('h:i', strtotime($row->date_count));
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

}
