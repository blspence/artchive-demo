<?php

namespace App\Http\Requests;

use App\Profile;
use App\Utilities\Regex;
use Illuminate\Foundation\Http\FormRequest;

class ProfileFormRequest extends FormRequest
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
            'biography'         => 'max:500',
            'profile_photo_url' => 'string',
            'profile_photo'     => 'sometimes|image',
            'major'             => 'max:255',
            'rso'               => 'max:255',
            'instagram_url'     => Regex::regexify(Regex::get_instagram_url_pattern()),
            'linkedin_url'      => Regex::regexify(Regex::get_linkedin_url_pattern()),
            'facebook_url'      => Regex::regexify(Regex::get_facebook_url_pattern())
        ];
    }
}
