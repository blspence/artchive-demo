{{--
    @author: Anna (jcwarric@svsu.edu)

    The archivist's show page displays all of the accepted artworks in an exhibit. 
    For each artwork, the archivist can choose to either use the student's photo
    as the publicly visible photo or the archivist can upload their own photo
    to be displayed on the exhibit's view page. 
    It is navigated to from the archivist show page.
--}}

@extends('layouts.app')

@section('title', 'Update Photos')

@section('content')
<div class="container-fluid">
        {!! Html::ul($errors->all()) !!}
    @if(count($artworks) > 0)
    {{-- if there are accepted artworks for the exhibit, display them in a table. --}}
        <div class="container-fluid col-sm-9" style="padding:50px;">
            <div >
                 {{-- <h1> {{$exhibit->title}} Artwork</h1>  --}}
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td>Artist Name</td>
                            <td>Artwork Title</td>
                            <td>Submission photo</td>
                            <td>Professional Photo</td>
                        </tr>
                    </thead>
                <tbody>

                    @foreach($artworks as $artwork)
                        <tr>
                            <td>{{$artwork->user->first_name}} {{$artwork->user->last_name}}</td>
                            <td>{{$artwork->title}}</td>
                            <td>
                                @if ($artwork->submission_photo_url != "")
                                    <img class="img-fluid" style="width:100px;height:100px;"
                                    src="{{$artwork->submission_photo_url}}" alt="Submitted photo for {{$artwork->title}}"/>
                                @endif
                            </td>
                            <td>
                                {{--  display the professional (archivist) photo if one already exists  --}}
                                @if ($artwork->public_photo_url != "")
                                    <img class="img-fluid" style="width:100px;height:100px;"
                                    src="{{$artwork->public_photo_url}}" alt="Public photo for {{$artwork->title}}'" />
                                @endif
                                {{--  form to upload or update the artwork's professional photo --}}
                                <form method="POST" action="/archivist/upload/{{ $artwork->id }}" enctype="multipart/form-data">
                                    @method('PATCH')
                                    @csrf
                                    <div class="input-group control-group" >
                                        <input type="file" name="archivist_photo" class="form-control">
                                    </div>
                                    <!-- student photo checkbox-->
                                    <div>
                                        <input type="checkbox" id="use_submission_photo" name="use_submission_photo"  value="yes">
                                        <label for="use_submission_photo">Use student's photo as public photo</label>
                                    </div>

                                    <button type="submit" class="btn btn-primary" style="margin:10px">Submit</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                </tbody>
                </table>
            </div>
            <div class="row d-flex justify-content-center">
                {{ $artworks->links()}}
            </div>
        </div>
    @else
        <h1>No submissions found for the exhibit </h1>
    @endif


</div>
@endsection
