<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Str;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'lname' => 'required|string|max:255',
            'fname' => 'required|string|max:255',
            'code' => 'required|string|size:10|regex:/[0-9]{10}/||unique:users',
            'phone_number' => 'required|string|regex:/(09)[0-9]{9}/|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:6',
            'user_image' => 'image',
            'date_employment' => 'string|max:255',
            'branch_work' => 'string|max:255',
            'user_description' => 'nullable|string|max:255',
        ]);

        $new_file_name = Str::random(45).'.'.$request->file('user_image')->getClientOriginalExtension();
        $result = $request->file('user_image')->move(public_path('user_image'),$new_file_name);
        if($result instanceof \Symfony\Component\HttpFoundation\File\File) {
            Auth::login($user = User::create([
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
            ]));
       }


        event(new Registered($user));

        return redirect(RouteServiceProvider::HOME);
    }
}
