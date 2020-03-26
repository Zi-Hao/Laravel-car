<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingsRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'subject' => 'required',
            'booking_time' => 'required',
            'coach' => 'required',
        ];
    }
    public function attributes()
    {
        return [
            'name' => '姓名',
            'subject' => '预约科目',
            'booking_time' =>'预约时间',
            'coach' => '教练'
        ];
    }
}
