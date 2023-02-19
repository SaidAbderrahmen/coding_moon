<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HiveUpdateRequest extends FormRequest
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
            'number' => ['required', 'numeric'],
            'total_bees' => ['required', 'numeric'],
            'present_bees' => ['required', 'numeric'],
            'infected_bees' => ['required', 'numeric'],
            'tempreture' => ['required', 'string'],
            'humidity' => ['required', 'string'],
            'status' => ['required', 'in:working,down'],
            'beekeeper_id' => ['required', 'exists:beekeepers,id'],
        ];
    }
}
