@extends('layouts.centered_content')

@section('title', 'Login')

@section('centered_content')

@card
    @slot('title', 'Login')

    @slot('body')
        <form method="POST" action="{{ route('login') }}">
            @csrf

            @input([
                'attribute'   => 'username',
                'placeholder' => '',
                'label'       => 'Username',
                'help_text'   => '',
                'type'        => 'text',
                'pattern'     => '',
                'value'       => '',
                'required'    => 'required'
            ])

            @input([
                'attribute'   => 'password',
                'placeholder' => '',
                'label'       => 'Password',
                'help_text'   => '',
                'type'        => 'password',
                'pattern'     => '',
                'value'       => '',
                'required'    => 'required'
            ])

            <div class="form-group row align-items-center">
                <div class="col-sm-6 offset-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember"
                            id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">Remember Me</label>
                    </div>
                </div>

                @button([
                    'type'      => 'submit',
                    'class'     => 'btn btn-primary',
                    'div_class' => 'col-sm-8 offset-sm-1',
                    'href'      => '',
                    'text'      => 'Login'
                ])
            </div>
        </form>
    @endslot
@endcard

@endsection
