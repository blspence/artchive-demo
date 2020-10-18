@extends('layouts.centered_content')

@section('title', 'Update Information')

@section('centered_content')

@card
    @slot('title', 'Update Information')

    @slot('body')
        <form method="POST" action="{{ route('user.update', $user) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            {{-- User include to UPDATE the model with attributes --}}
            @user([
                'value_first_name'   => $user->first_name,
                'value_last_name'    => $user->last_name,
                'value_phone_number' => $user->phone_number,
                'purpose'            => 'update'
            ])

            {{-- Use include submit form or 'cancel' --}}
            @buttons_confirm_cancel([
                'route'  => 'user.show',
                'object' => $user
            ])

        </form>
    @endslot
@endcard

@endsection
