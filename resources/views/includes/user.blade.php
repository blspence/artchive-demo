{{-- used for creating or updating the User model --}}

@if($purpose == 'create') {{-- PROVIDE 'purpose' as either 'create' or 'update' --}}
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

    @input([
        'attribute'   => 'password_confirmation',
        'placeholder' => '',
        'label'       => 'Confirm Password',
        'help_text'   => '',
        'type'        => 'password',
        'pattern'     => '',
        'value'       => '',
        'required'    => 'required'
    ])

@elseif($purpose == 'update')
    @input([
        'attribute'   => 'first_name',
        'placeholder' => '',
        'label'       => 'First Name',
        'help_text'   => '',
        'type'        => 'text',
        'pattern'     => '',
        'value'       => $value_first_name, // PROVIDE
        'required'    => 'required'
    ])

    @input([
        'attribute'   => 'last_name',
        'placeholder' => '',
        'label'       => 'Last Name',
        'help_text'   => '',
        'type'        => 'text',
        'pattern'     => '',
        'value'       => $value_last_name, // PROVIDE
        'required'    => 'required'
    ])

    @input([
        'attribute'   => 'phone_number',
        'label'       => 'Phone',
        'help_text'   => 'format: 555-555-5555',
        'placeholder' => '',
        'type'        => 'text',
        'pattern'     => \App\Utilities\Regex::get_phone_number_pattern(),
        'value'       => $value_phone_number, // PROVIDE
        'required'    => 'required'
    ])

    {{-- User Role: show only to Admins --}}
    @if(Auth::user()->isAuthorized("ADMIN"))
        @dropdown([
            'attribute'   => 'role',
            'label'       => 'Role',
            'condition'   => $user->getRole(),
            'options'     => $user->getAllRoles(),
        ])
    @endif
@endif
