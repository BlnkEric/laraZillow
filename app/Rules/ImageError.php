<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ImageError implements Rule
{
    public $exists;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // $Rules = [   
        //     'images.*' => 'required|mimes:jpg,jpeg,png',
        // ];
        // dd($attribute,$value);

        // $arr = explode("\\", $value->path());
        // var_dump(end($arr));
        // $validator = Validator::make($value->all(), [
        //     'images' => 'required|mimes:jpg,jpeg,png',
        // ]);
        // var_dump($attribute,$value);

        // if(!$validator->fails()) {
        //     return true;
        // } else {
        //     $this->exists = end($arr);
        //     return false;
        // }
        // return !$validator->fails();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        // return "image with name {$this->exists} should be in one of the formats :jpg, jpeg, png";
    }
}
