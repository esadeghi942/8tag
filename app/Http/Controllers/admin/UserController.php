<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $users = User::all();
        return view('admin.users.list', compact('users'));
    }

    public function create()
    {
        return view('admin.users.add');
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

    public function show($user_id)
    {
        //
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
                return redirect()->route('admin.user')->with('success', 'کاربر مورد نظر با موفقیت حذف گردید.');
            }
            return redirect()->route('admin.user')->with('danger', 'حذف کاربر ممکن نیست.');
        }
    }

}
