<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateListingRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'beds' => 'required|integer|min:0|max:10',
            'baths' => 'required|integer|min:0|max:10',
            'area' => 'required|integer|min:10|max:1000',
            'city' => 'required',
            'code' => 'required',
            'street' => 'required',
            'street_nr' => 'required|integer',
            'price' => 'required|integer|min:10|max:200000000',
        ];
    }

    public function messages()
    {
        return [
            'area.min' => 'area must be at least 10 square meter'
        ];
    }
}
