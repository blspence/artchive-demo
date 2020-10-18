<?php

namespace App\Http\Requests;

use App\Utilities\Regex;
use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public static function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @todo discuss max attribute lengths
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'username'     => 'required|string|max:255|unique:users',
            'phone_number' => 'required|string|max:255|' . Regex::regexify(Regex::get_phone_number_pattern()),
            'password'     => 'required|string|min:8|confirmed',
            'role'         => 'string'
        ];
    }
}
