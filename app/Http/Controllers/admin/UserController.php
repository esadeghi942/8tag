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

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return view('admin.users.list');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('user_image', function(User $user){
                    return url('user_image\\').$user->user_image;
                })
                ->addColumn('name', function(User $user){
                    return $user->fname. '  '.$user->lname ;
                })
                ->addColumn('action', function(User $user){
                    $actionBtn = '<a href="/admin/user/edit/'.$user->user_id.'" class="edit btn btn-success btn-sm">ویرایش</a>
                                  <a data-user="'.$user->user_id.'" class="delete btn btn-danger btn-sm">حذف</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action','name'])
                ->make(true);
        }
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(UserRequest $request)
    {
        $new_file_name = '';
        if ($request->file('user_image')) {
            $new_file_name = Str::random(45) . '.' . $request->file('user_image')->getClientOriginalExtension();
            $result = $request->file('user_image')->move(public_path('user_image'), $new_file_name);
        }
        User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'code' => $request->code,
            'phone_number' => $request->phone_number,
            'user_image' => $new_file_name,
            'date_employment' => $request->date_employment,
            'branch_work' => $request->branch_work,
            'user_description' => $request->user_description
        ]);
        return redirect()->route('admin.user')->with('success', 'کاربر جدید با موفقیت ثبت گردید.');
    }

    public function edit($user_id)
    {
        if ($user_id && ctype_digit($user_id)) {
            $userItem = User::find($user_id);
            if ($userItem && $userItem instanceof User) {
                return view('admin.users.edit', compact('userItem'));
            }
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
            'branch_work' => $request->branch_work,
            'user_description' => $request->user_description];
        if (request()->input('password') === null) {
            unset($inputs['password']);
        }
        if($request->file('user_image')=== null) {
            unset($inputs['user_image']);
        }
        $update = $user->update($inputs);
        if ($update) {
            return redirect()->route('admin.user')->with('success', 'کاربر با موفقیت به روز رسانی شد.');
        }
    }

    public function delete($user_id)
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
