@extends('layouts.centered_content')

@section('title', 'Information')

@section('centered_content')

@card
    @slot('title', 'Information')

    {{-- Update Button --}}
    @slot('button', 'button')
        @slot('route', 'user.edit')
        @slot('object', $user)
        @slot('button_text', 'Update')

    @slot('body')
        <form method="GET" action="{{ route('user.show', $user) }}" enctype="multipart/form-data">
            @csrf
            <div class="offset-sm-2">
                <div class="row justify-content-center">
                    <h4>{{ $user->first_name }} {{ $user->last_name }}</h4>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-10 offset-2">
                        @output
                            @slot('label', 'Username')

                            @slot('attribute')
                                {{ $user->username }}
                            @endslot
                        @endoutput

                        @output
                            @slot('label', 'Phone')

                            @slot('attribute')
                                {{ $user->phone_number }}
                            @endslot
                        @endoutput

                        {{-- User Role: show only to Admins --}}
                        @if(Auth::user()->isAuthorized("ADMIN"))
                            @output
                                @slot('label', 'Role')

                                @slot('attribute')
                                    {{ $user->getRole() }}
                                @endslot
                            @endoutput
                        @endif
                    </div>
                </div>
            </div>
        </form>
    @endslot
@endcard

@endsection
