<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules =  [
            'lname' => 'required|string|max:255',
            'fname' => 'required|string|max:255',
            'user_image' => 'image',
            'date_employment' => 'string|max:255',
            'user_description' => 'nullable|string|max:255',
        ];

        if (request()->route('user_id') && intval(request()->route('user_id')) > 0) {
            $rules['code'] = 'required|string|size:10|regex:/[0-9]{10}/';
            $rules['phone_number'] = 'required|string|regex:/(09)[0-9]{9}/';
            $rules['email'] = 'required|string|email|max:255';
            $rules['password'] = 'confirmed';
        }
        else{
            $rules['password']='required|string|confirmed|min:6';
            $rules['code'] = 'required|string|size:10|regex:/[0-9]{10}/|unique:users';
            $rules['phone_number'] = 'required|string|regex:/(09)[0-9]{9}/|unique:users';
            $rules['email'] = 'required|string|email|max:255|unique:users';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => 'وارد کردن :attribute الزامی می باشد',
            'numeric' =>':attribute باید از نوع عددی باشد ',
            'string' =>':attribute باید از نوع رشته باشد ',
            'unique' =>':attribute قبلا در سیستم ثبت شده است ',
            'email' =>':attribute باید به فرمت ایمیل باشد ',
            'max' =>':attribute باید حداکثر 255 کاراکتر ',
            'min' =>':attribute باید حداقل 6 کاراکتر ',
            'regex' =>'فرمت :attribute صحیح نیست',
            'confirmed' =>'تایید  :attribute صحیح نیست',
            'size' =>'سایز  :attribute صحیح نیست',
        ];
    }

    public function attributes()
    {
        return [
            'fname' => 'نام',
            'lname' => 'نام خانوادگی',
            'email' => 'ادرس ایمیل',
            'phone_number' => 'شماره تماس',
            'code' => 'کد ملی',
            'password' => 'پسورد',
            'branch_work' => 'شاخه کاری',
            'user_image' => 'عکس',
            'user_description' => 'توضیحات',
            'date_employment' => 'تاریخ استخدام',
        ];
    }
}
