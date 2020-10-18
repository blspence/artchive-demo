@extends('layouts.centered_content')

@section('title', 'Profile')

@section('centered_content')

@card
    @slot('title')
        {{$user->first_name}} {{$user->last_name}}
    @endslot

@slot('body')
    {{-- Update Button --}}
    @slot('button', 'button')
        @slot('route', 'profile.edit')
        @slot('object', $profile)
        @slot('button_text', 'Update')

    @slot('body')
        <form method="GET" action="{{ route('profile.show', $profile) }}" enctype="multipart/form-data">
            @csrf
            <div class="offset-sm-3">
                <div class="row justify-content-center">
                    @profile_photo
                        @slot('src')
                            {{ $profile->profile_photo_url }}
                        @endslot
                    @endprofile_photo
                </div>

                {{-- Social Media Links --}}
                @if(!empty($profile->instagram_url) ||
                    !empty($profile->linkedin_url))
                <div class="row justify-content-center">
                    {{-- Facebook --}}
                    @if(!empty($profile->facebook_url))
                        <a href="{{ $profile->facebook_url }}"
                            class="fa fa-social fa-facebook"
                            target="_blank"
                            aria-hidden="true"
                            aria-label="Visit the user's Facebook page"></a>
                    @endif

                    {{-- Instagram --}}
                    @if(!empty($profile->instagram_url))
                        <a href="{{ $profile->instagram_url }}"
                            class="fa fa-social fa-instagram"
                            target="_blank"
                            aria-hidden="true"
                            aria-label="Visit the user's Instagram page"></a>
                    @endif

                    {{-- LinkedIn --}}
                    @if(!empty($profile->linkedin_url))
                        <a href="{{ $profile->linkedin_url }}"
                            class="fa fa-social fa-linkedin"
                            target="_blank"
                            aria-hidden="true"
                            aria-label="Visit the user's LinkedIn page"></a>
                    @endif
                </div>
                @endif

                @if(!empty($profile->biography)){{--  ||
                    !empty($profile->major) ||
                    !empty($profile->rso)) --}}
                    <div class="row justify-content-center">
                        {{-- Major
                        @if(!empty($profile->major))
                            @output
                                @slot('label', 'Major')

                                @slot('attribute')
                                    {{ $profile->major }}
                                @endslot
                            @endoutput
                        @endif --}}

                        {{-- RSOs
                        @if(!empty($profile->rso))
                            @output
                                @slot('label', 'RSOs')

                                @slot('attribute')
                                    {{ $profile->rso }}
                                @endslot
                            @endoutput
                        @endif --}}

                        {{-- Biography --}}
                        @if(!empty($profile->biography))
                            {{-- <div class="form-group row"> --}}
                                {{-- <div class="col-sm-2 text-sm-left" style="margin-right: 5px;">
                                    <label class="form-label"><strong>Biography:</strong></label>
                                {{-- </div>
                                <div class="col-sm-8 text-sm-left"> --}}
                                    <div class="form-label"
                                           style="max-width: 400px; word-wrap: break-word">
                                           {{$profile->biography}}</div>
                                {{-- </div> --}}
                            {{-- </div> --}}
                        @endif
                    </div>
                @endif
            </div>
        </form>
    @endslot
@endcard

{{-- User's Public Artworks --}}
@if(count($artworks) > 0)
    @card
        @slot('title')
            {{$user->first_name}}'s Artwork
        @endslot

        @slot('body')
            {{-- don't show button if user id doesn't match or not an admin --}}

            @if(Auth::user()->id == $user->user_id)
                {{-- Add Artwork Button --}}
                @slot('button', 'button')
                    @slot('route', 'artwork.create')
                    @slot('object', null)
                    @slot('button_text', '+Add Artwork')
            @endif

            <div class="row justify-content-center offset-sm-1">
                @component('components.artwork_grid_component',
                    ['artworks' => $artworks])
                @endcomponent
            </div>
        @endslot
    @endcard
@endif

@endsection
