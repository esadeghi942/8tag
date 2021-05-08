<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class WorktimeRequest extends FormRequest
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
        return [
            'date'=>'string|required',
            'time_start'=>'string|required',
            'time_finish'=>'string|required|after:time_start',
            'total'=>'numeric|required|min:0',
            'reduce'=>'numeric|required|min:0',
            'teleworking'=>'numeric|required|min:0|',
        ];
    }


    public function messages()
    {
        return [
            'required' => 'وارد کردن :attribute الزامی می باشد',
            'numeric' =>':attribute باید از نوع عددی باشد ',
            'after' =>' ساعت خروج باید بیشتر از ساعت شروع باشد.',
            'min'=>'حداقل مقدار ورودی :attribute عدد صفر است. '
        ];
    }

    public function attributes()
    {
        return [
            'date'=>'روز مرخصی',
            'time_start'=>'ساعت شروع مرخصی',
            'time_finish'=>'ساعت پایان مرخصی',
            'total'=>'مجموع',
            'reduce'=>'کسر',
            'teleworking'=>'دورکاری',
        ];
    }
}
