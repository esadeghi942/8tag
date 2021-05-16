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
        if ($this->request->get('type') == 1) {
            return ['type' => 'string|required',
                'start' => 'string|required',
                'finish' => 'string|required',
                'description' => 'string|required'];
        }
        else if($this->request->get('type') == 2) {
            return ['type' => 'string|required',
                'time_start' => 'string|required',
                'time_finish' => 'string|required|after:time_start',
                //'date_count'=>'numeric|required',
                'description' => 'string|required'];
        }
    }

    public function messages()
    {
        return [
            'required' => 'وارد کردن :attribute الزامی می باشد',
            'numeric' =>':attribute باید از نوع عددی باشد ',
            'string' =>':attribute باید از نوع رشته باشد ',
            'after' =>' زمان پایان باید بیشتر از زمان شروع باشد.'
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
