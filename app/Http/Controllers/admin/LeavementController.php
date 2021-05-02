<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Leavement;
use App\Models\User;
use App\Models\Worktime;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LeavementController extends Controller
{
    public function index()
    {
        return view('admin.leavement.list');
    }

    public function agree($leavement_id)
    {
        $item=Leavement::find($leavement_id);
        $item->status=2;
        $item->save();
        return response('success');
    }

    public function disagree($leavement_id)
    {
        $item=Leavement::find($leavement_id);
        $item->status=1;
        $item->save();
        return response('success');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = Leavement::select('id','fname','lname','phone_number','leavements.type','start','finish',
                'date_count','description','status')->join('users','users.user_id','=','leavements.user_id')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function(Leavement $leavement){
                    $actionBtn = '<a data-id="'.$leavement->id.'" class="agree btn btn-success btn-sm">قبول</a>
                                  <a data-id="'.$leavement->id.'" class="disagree btn btn-danger btn-sm">رد</a>';
                    return $actionBtn;
                })->addColumn('name',function($row){
                    return $row->fname.'  '.$row->lname;
                })->
                editColumn('type',function ($row){
                    if($row->type=='1')
                        return 'روزانه';
                    else if($row->type=='2')
                        return 'ساعتی';
                })
                ->rawColumns(['action','name'])
                ->make(true);
        }
    }
    public function worktime($user_id)
    {

        return view('admin.worktime.list');
    }
}
