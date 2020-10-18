{{--
    This include to handle a textarea input field
    
    @author: Anna (jcwarric@svsu.edu)

    @example:

        @textarea([
        'attribute' => 'description',
        'placeholder' => 'Description',
        'label' => 'Description',
        'help_text' => 'Minimum of 3 characters, maximum of 255.',
        'rows' => '4',
        'value' => '',
        'required' => 'required'
    ])

--}}
<div class="form-group row align-items-center">

    {{-- define the label --}}
    <div class="col-sm-4 text-md-right">
        {{--  attribute indicates the name of the input field that will be passed
            to the controller  --}}
        <label for="{{ $attribute }}"
                class="form-label">
                <strong>{{ $label }}</strong>
        </label>
    </div>
    
    {{-- define the textarea --}}
    <div class="col-sm-8">
        <textarea 
            id="{{ $attribute }}"
            class="form-control{{ $errors->has($attribute) ? ' is-invalid' : '' }}"
            name="{{ $attribute }}" 
            placeholder="{{ $placeholder }}"
            {{ $required }} autofocus>@if(!empty($value)){{$value}}@endif
        </textarea>
            
        {{-- include help text --}}
        @if(!empty($help_text))
            <small class="form-text text-muted">{{ $help_text }}</small>
        @endif

        {{-- display any errors --}}
        @if($errors->has($attribute))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first($attribute) }}</strong>
            </span>
        @endif
    </div>
</div>
    