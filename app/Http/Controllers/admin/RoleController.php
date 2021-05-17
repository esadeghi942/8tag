<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function index()
    {
        return view('admin.role.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.create');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function(Role $role){
                    $actionBtn = '<a href="/admin/role/edit/'.$role->id.'" class="edit btn btn-success btn-sm"><span title="ویرایش" class="fa fa-edit"></span></a>
                                  <a data-id="'.$role->id.'" class="delete btn btn-danger btn-sm"><span title="حذف" class="fa fa-trash"></span></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->validate(['title'=>'required|string']);
       Role::create(['name'=>$request->title]);
       return redirect()->route('admin.role.index')->with('success', 'شاخه کاری جدید با موفقیت ثبت گردید.');
    }

       public function edit($id)
    {
        $roleItem=Role::find($id);
        return view('admin.role.edit',compact('roleItem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(['title'=>'required|string']);
        $role=Role::find($id);
        $role->update(['name'=>$request->title]);
        return redirect()->route('admin.role.index')->with('success', 'شاخه کاری جدید با موفقیت ویرایش گردید.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$role_id)
    {
        if ($request->ajax() && $role_id && ctype_digit($role_id)) {
            $roleItem=Role::find($role_id);
            if ($roleItem && $roleItem instanceof Role) {
                $roleItem->delete();
                return response('success');
            }
            return response('error');
        }

    }
}
