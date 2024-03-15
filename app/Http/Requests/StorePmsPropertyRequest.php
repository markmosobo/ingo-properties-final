<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePmsPropertyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'landlord_id' => 'required',
            'units_no' => 'required',
            'commission' => 'required'

        ];
    }
}
