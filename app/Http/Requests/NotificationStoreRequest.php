<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotificationStoreRequest extends FormRequest
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
            'event' => [
                'required',
                'in:infected bee,hornet detected,temperature change',
            ],
            'details' => ['required', 'string'],
            'hive_id' => ['required', 'exists:hives,id'],
            'date' => ['required', 'date'],
        ];
    }
}
