<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Session;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return view('admin.users.index');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('user_image', function(User $user){
                    return $user->user_image ?url('user_image\\').$user->user_image:'';
                })
                ->editColumn('phone_number',function ($row){
                    return $row->phone_number;
                })
                ->editColumn('code',function ($row){
                    return $row->code;
                })
                ->addColumn('name', function(User $user){
                    return $user->fname. '  '.$user->lname ;
                })
                ->addColumn('branch_work', function(User $user){
                    return implode(',',$user->roles->pluck('name')->all()) ;
                })
                ->addColumn('action', function(User $user){
                    $actionBtn = '<a href="/admin/user/edit/'.$user->user_id.'" class="edit btn btn-success btn-sm"><span title="ویرایش" class="fa fa-edit"></span></a>
                                  <a href="/admin/user/'.$user->user_id.'/worktime" class="btn btn-success btn-sm"><span title="ساعات کاری" class="fa fa-tasks"></span></a>
                                  <a data-user="'.$user->user_id.'" class="delete btn btn-danger btn-sm"><span title="حذف" class="fa fa-trash"></span></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action','name','branch_work'])
                ->make(true);
        }
    }

    public function create()
    {
        $roles=Role::all();
        return view('admin.users.create',compact('roles'));
    }

    public function store(UserRequest $request)
    {
        $new_file_name = '';
        if ($request->file('user_image')) {
            $new_file_name = Str::random(45) . '.' . $request->file('user_image')->getClientOriginalExtension();
            $result = $request->file('user_image')->move(public_path('user_image'), $new_file_name);
        }
        $new_user=User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'code' => $request->code,
            'phone_number' => $request->phone_number,
            'user_image' => $new_file_name,
            'date_employment' => $request->date_employment,
            'user_description' => $request->user_description
        ]);
        if($request->has('branch_work'))
            $new_user->assignRole($request->input('branch_work'));
        return redirect()->route('admin.user.index')->with('success', 'کاربر جدید با موفقیت ثبت گردید.');
    }

    public function edit($user_id)
    {
        if ($user_id && ctype_digit($user_id)) {
            $userItem = User::find($user_id);
            $roles = Role::all();
            $userrole = $userItem->roles->pluck('id')->toArray();
            return view('admin.users.edit', compact('userItem','roles','userrole'));
            }
    }

    public function update(UserRequest $request, $user_id)
    {
        $new_file_name = '';
        $user_id = intval($user_id);
        $user = User::find($user_id);
        if ($request->file('user_image')) {
            $image = $user->user_image;
            if ($image !== '' && file_exists(public_path('user_image\\') . $image))
                unlink(public_path('user_image\\') . $image);
            $new_file_name = Str::random(45) . '.' . $request->file('user_image')->getClientOriginalExtension();
            $request->file('user_image')->move(public_path('user_image'), $new_file_name);
        }
        $inputs = ['fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'code' => $request->code,
            'phone_number' => $request->phone_number,
            'user_image' => $new_file_name,
            'date_employment' => $request->date_employment,
            'user_description' => $request->user_description];
        if (request()->input('password') === null) {
            unset($inputs['password']);
        }
        if($request->file('user_image')=== null) {
            unset($inputs['user_image']);
        }
        //$user->roles()->sync($request->input('branch_work'));
        if($request->has('branch_work'))
            $user->assignRole($request->input('branch_work'));

        $update = $user->update($inputs);
        if ($update) {
            return redirect()->route('admin.user.index')->with('success', 'کاربر با موفقیت به روز رسانی شد.');
        }
    }

    public function destroy($user_id)
    {
        if ($user_id && ctype_digit($user_id)) {
            $userItem = User::find($user_id);
            if ($userItem && $userItem instanceof User && $userItem->user_id != Auth::id()) {
                $image = $userItem->user_image;
                if ($image !== '' && file_exists(public_path('user_image\\') . $image))
                    unlink(public_path('user_image\\') . $image);
                $userItem->delete();
                return response('success');
            }
            return response('error');
        }
    }

}
