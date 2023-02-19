<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BeekeeperUpdateRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'string'],
            'email' => ['required', 'email'],
            'phone_number' => ['required', 'max:255', 'string'],
            'address' => ['required', 'string'],
            'password' => ['nullable'],
        ];
    }
}
