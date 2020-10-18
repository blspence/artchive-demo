{{-- used for creating or updating the profile model --}}

@input([
    'attribute'   => 'profile_photo',
    'placeholder' => '',
    'label'       => 'Profile Photo',
    'help_text'   => '',
    'type'        => 'file',
    'pattern'     => '',
    'value'       => '',
    'required'    => ''
])

@if(!empty($biography)) {{-- PROVIDE --}}
    <div class="form-group row">
        <label class="col-sm-4 col-form-label text-md-right" for="biography">
            <strong>Biography</strong></label>

        <div class="col-sm-8">
            <textarea type="text"
                      class="form-control{{ $errors->has('biography') ? ' is-invalid' : '' }}"
                      name="biography" id="biography" rows="4">{{ $profile->biography}}
                    </textarea>

            @if ($errors->has('biography'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('biography') }}</strong>
                </span>
            @endif
        </div>
    </div>
@endif

@input([
    'attribute'   => 'major',
    'placeholder' => '',
    'label'       => 'Major',
    'help_text'   => '',
    'type'        => 'text',
    'pattern'     => '',
    'value'       => $value_major, // PROVIDE
    'required'    => ''
])

@input([
    'attribute'   => 'rso',
    'placeholder' => '',
    'label'       => 'RSOs',
    'help_text'   => '',
    'type'        => 'text',
    'pattern'     => '',
    'value'       => $value_rso, // PROVIDE
    'required'    => ''
])

@input([
    'attribute'   => 'facebook_url',
    'placeholder' => '',
    'label'       => 'Facebook Profile',
    'help_text'   => 'format: https://www.facebook.com/USERNAME',
    'type'        => 'text',
    'pattern'     => \App\Utilities\Regex::get_facebook_url_pattern(),
    'value'       => $value_facebook_url, // PROVIDE
    'required'    => ''
])

@input([
    'attribute'   => 'instagram_url',
    'placeholder' => '',
    'label'       => 'Instagram Profile',
    'help_text'   => 'format: https://www.instagram.com/USERNAME',
    'type'        => 'text',
    'pattern'     => \App\Utilities\Regex::get_instagram_url_pattern(),
    'value'       => $value_instagram_url, // PROVIDE
    'required'    => ''
])

@input([
    'attribute'   => 'linkedin_url',
    'placeholder' => '',
    'label'       => 'LinkedIn Profile',
    'help_text'   => 'format: https://www.linkedin.com/in/USERNAME',
    'type'        => 'text',
    'pattern'     => \App\Utilities\Regex::get_linkedin_url_pattern(),
    'value'       => $value_linkedin_url, // PROVIDE
    'required'    => ''
])
