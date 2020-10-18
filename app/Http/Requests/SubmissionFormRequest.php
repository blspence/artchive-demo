<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmissionFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'comments' => 'max:1000' //TODO: are we sure that we want to limit Tisch to 1000 characters? the value feels kinda random
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function experimental_rules()
    {
        return [
            'rso'                   => 'required|boolean',
            'rso_name'              => 'sometimes|max: 255',
            'rso_num_participants'  => 'sometimes|integer| min:0',
            'faculty_adviser'       => 'sometimes|max: 255',
            'walls'                 => 'required|integer',
            'pedestals'             => 'required|integer',
            'brick_ok'              => 'required',
            'comments'              => 'max:1000'
        ];
    }
}
