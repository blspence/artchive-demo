{{--
    Include to handle a single form input row with a label and input field
    An example of using this layout:

    @input([
    'attribute'   => 'facebook_url', //required
    'placeholder' => '',
    'label'       => 'Facebook Profile',
    'help_text'   => 'format: https://www.facebook.com/USERNAME',
    'type'        => 'text',
    'pattern'     => \App\Utilities\Regex::get_facebook_url_pattern(),
    'value'       => $value_facebook_url, // PROVIDE
    'required'    => ''
    ])

--}}
<div class="form-group row align-items-center">

    <div class="col-sm-4 text-md-right">
        {{--  attribute indicates the name of the input field that will be passed
            to the controller  --}}
        <label for="{{ $attribute }}"
               class="form-label">
               <strong>{{ $label }}</strong>
        </label>
    </div>

    <div class="col-sm-8">
            <input id="{{ $attribute }}" type="{{ $type }}"
                class="form-control{{ $errors->has($attribute) ? ' is-invalid' : '' }}"
                placeholder="{{ $placeholder }}" name="{{ $attribute }}"

                {{--  pattern for regex validation  --}}
                @if(!empty($pattern))
                    pattern="{{ $pattern }}"
                @endif

                value="{{ $value }}" {{ $required }} autofocus>
            
            @if(!empty($help_text))
               <small class="form-text text-muted">{{ $help_text }}</small>
            @endif

        @if($errors->has($attribute))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first($attribute) }}</strong>
            </span>
        @endif
    </div>
</div>
