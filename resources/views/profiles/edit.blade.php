@extends('layouts.centered_content')

@section('title', 'Update Profile')

@section('centered_content')

@card
    @slot('title', 'Update Profile')

    @slot('body')
        <form method="POST" action="{{ route('profile.update', $profile) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="row justify-content-center offset-sm-2">
                @profile_photo
                    @slot('src')
                        {{ $profile->profile_photo_url }}
                    @endslot
                @endprofile_photo
            </div>
            <hr>

            {{-- Profile include to UPDATE the model with attributes --}}
            @profile([
                'biography'           => 'biography',
                'value_major'         => $profile->major,
                'value_rso'           => $profile->rso,
                'value_facebook_url'  => $profile->facebook_url,
                'value_instagram_url' => $profile->instagram_url,
                'value_linkedin_url'  => $profile->linkedin_url
            ])

            {{-- Use include submit form or 'cancel' --}}
            @buttons_confirm_cancel([
                'route'  => 'profile.show',
                'object' => $profile
            ])

        </form>
    @endslot
@endcard

@endsection
