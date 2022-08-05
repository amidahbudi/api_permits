<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermitStoreRequest extends FormRequest
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
            'user_id' => 'required|numeric',
            'type' => 'required|in:full time,part time',
            'desc' => 'required',
            'status' => 'required|in:pending,approved',
            'permit_date.*.date' => 'required',
            'permit_date.*.start_at' => 'required',
            'permit_date.*.end_at' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'User is not valid!',
            'type.required' => 'Type permit is not valid!',
            'desc.required' => 'Desc is required!',
            'status.required' => 'Status permit not valid!',
            'permit_date.*.date.required' => 'Permit date is required!',
            'permit_date.*.start_at.required' => 'Permit Start time is required!',
            'permit_date.*.end_at.required' => 'Permit finish time is required!'
        ];
    }

}
