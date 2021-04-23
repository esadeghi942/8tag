<?php

namespace App\Http\Requests;

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
        return true;
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
            'time_finish'=>'string|required',
            'total'=>'numeric|required',
            'reduce'=>'numeric|required',
            'teleworking'=>'numeric|required',
        ];
    }


    public function messages()
    {
        return [
            'required' => 'وارد کردن :attribute الزامی می باشد',
            'numeric' =>':attribute باید از نوع عددی باشد '
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
