@extends('layouts.app')

@section('title', 'Show Artwork')
@section('content')
<div class="container col-sm-9 col-md-8 col-lg-5 col-xl-4 justify-content-center">
   
        <div class="card" style="">
            <img class="card-img-top img-fluid"  src="{{$artwork->public_photo_url}}" alt="image" />
            <div class="card-body">
                <h4 class="card-title">{{ $artwork->title }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">Artist: <a href="{{route('profile.show', $artwork->user_id)}}">
                    {{$artwork->user->first_name}} {{$artwork->user->last_name}}</a></h6>
                <p class="card-text">
                <span class="text-muted">Medium: {{ $artwork->medium }}</span> 
                <br>
                <span class="text-muted">Description: {{ $artwork->description }}</span>
                <br>
                {{--  If the user is viewing his or her artwork, allow them to navigate to the update page.  --}}
                @if(Auth::user()->id == $artwork->user_id)
                    <a href="{{route('artwork.edit', $artwork->id)}}" title="Edit My Artwork">Edit</a>
                @endif 
            </p>
            </div>

    
    </div>
</div>


@endsection
