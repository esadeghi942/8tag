<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class LeavementRequest extends FormRequest
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
        return  ['type'=>'string|required',
            'start'=>'string|required',
            'finish'=>'string|required',
            'date_count'=>'numeric|required',
            'description'=>'string|required'];
    }

    public function messages()
    {
        return [
            'required' => 'وارد کردن :attribute الزامی می باشد',
            'numeric' =>':attribute باید از نوع عددی باشد ',
            'string' =>':attribute باید از نوع رشته باشد '
        ];
    }

    public function attributes()
    {
        return [
            'type' => 'نوع مرخصی',
            'start' => 'تاریخ شروع',
            'finish' => 'تاریخ پایان',
            'date_count' => 'تعداد روز کاری',
            'description' => 'توضیحات',
        ];
    }
}
