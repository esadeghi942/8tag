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
            'branch_work' => 'string|max:255',
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
            'title.required' => 'A title is required',
            'body.required' => 'A message is required',
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'email address',
        ];
    }
}
