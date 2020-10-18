<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

interface FormRules {
    public function rules();
}

class ExhibitFormRequest extends FormRequest implements FormRules
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
     *  @todo: add in time and date validation
     * @return array
     */
    public function rules()
    {
        return [
            'title'                         => 'required|min:3|max:255',
            'type'                          => 'required|min:0|max:2',
            'description'                   => 'required|min:3',
            'start_date_time'               => 'required|date',
            'end_date_time'                 => 'required|date',
            'registration_start_date_time'  => 'required|date',
            'registration_end_date_time'    => 'required|date',
            'reception_start_date_time'     => 'required|date',
            'reception_end_date_time'       => 'required|date',
            'published'                     => 'sometimes|accepted',
            'default_accept_message'        => 'required',
            'default_reject_message'        => 'required'
        ];
    }
}


class ImageRequiredExhibitFormRules implements FormRules {

    //instance of service
    protected $formRules;

    public function __construct(FormRules $formRules) {
        $this->formRules = $formRules;
    }

    public function rules(){
        return array_merge( $this->formRules->rules(), [
            'featured_image'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
    }
}

class ImageSometimesExhibitFormRules implements FormRules {

    //instance of service
    protected $formRules;

    public function __construct(FormRules $formRules) {
        $this->formRules = $formRules;
    }

    public function rules(){
        return array_merge( $this->formRules->rules(), [
            'featured_image'  => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
    }
}
