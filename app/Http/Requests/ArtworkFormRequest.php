<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\FormRules;

class ArtworkFormRequest extends FormRequest
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
            'title'             => 'required|min:3|max:255',
            'medium'            => 'required|min:3|max:255',
            'description'       => 'required|min:3|max:255',
            'semester'          => 'sometimes|max:20',
            'course'            => 'sometimes|min:3|max:255',
            'instructor'        => 'sometimes|min:3|max:255',
            'submission_photo'  => 'sometimes|image'
        ];
    }

    /**
     * Get the validation rules for updating the public photo of an artwork,
     * typically during the exhibit (after the artwork is initially submitted)
     *
     * @return array
     */

     public static function archivist_rules(){
         return[
            'use_public_photo'  => 'sometimes|accepted',
            'archivist_photo'   => 'sometimes|image'
         ];
     }

     /**
      * validation for storing multiple objects
      * @return array
      */

      public static function rules_many(){
        return[
            'submission_id'         => 'sometimes|integer',
            'title'                 => 'required|array|min:1|max:20',
            'title.*'               => 'required|min:3|max:255',
            'instructor'            => 'sometimes|array',
            'instructor.*'          => 'sometimes|min:3|max:255',
            'course'                => 'sometimes|array|max:255',
            'course.*'              => 'sometimes|min:3|max:255',
            'semester'              => 'sometimes|array',
            'semester.*'            => 'sometimes|min:3|max:255',
            'medium'                => 'required|array|min:1',
            'medium.*'              => 'required|min:3|max:255',
            'description'           => 'required|array|min:1',
            'description.*'         => 'required|min:3',
            'submission_photo'      => 'sometimes|array',
            'submission_photo.*'    => 'sometimes|image',
            'archivist_photo'       => 'sometimes|array',
            'archivist_photo.*'     => 'sometimes|image'
        ];
      }

      public static function rules_annual_student_show(){
        return[
            'submission_id'         => 'sometimes|integer',
            'title'                 => 'required|array|min:1|max:3',
            'title.*'               => 'required|min:3|max:255',
            'instructor'            => 'sometimes|array',
            'instructor.*'          => 'sometimes|min:3|max:255',
            'course'                => 'sometimes|array|max:255',
            'course.*'              => 'sometimes|min:3|max:255',
            'semester'              => 'sometimes|array',
            'semester.*'            => 'sometimes|min:3|max:255',
            'medium'                => 'required|array|min:1',
            'medium.*'              => 'required|min:3|max:255',
            'description'           => 'required|array|min:1',
            'description.*'         => 'required|min:3',
            'submission_photo'      => 'sometimes|array',
            'submission_photo.*'    => 'sometimes|image',
            'archivist_photo'       => 'sometimes|array',
            'archivist_photo.*'     => 'sometimes|image'
        ];
      }
}
