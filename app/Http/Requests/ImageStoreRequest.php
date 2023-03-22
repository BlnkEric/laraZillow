<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule as ValidationRule;

class ImageStoreRequest extends FormRequest
{
    public $exists;

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
        Validator::extend('images', function($attribute, $value, $parameters)
        {
            $arr = explode("\\", $value->path());
            var_dump(end($arr));

            if(ValidationRule::imageFile()) {
                return true;
            } else {
                $this->exists = end($arr);
                return false;
            }
        });


        // return !$validator->fails();

        Validator::replacer('time_clash_check', function($message, $attribute, $rule, $parameters) {
            return str_replace(':variable', $this->exists, $message);
        });   

        $rules = [
            'images' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'time_clash_check' => $this->exists . ' has clashed'
        ];
    }
}
