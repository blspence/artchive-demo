@extends('layouts.app')

@section('title', 'View Artwork')

@section('content')

<div class="container">
    <div class="row">
        <h1>Student Artwork</h1>
    </div>

    {{--  Form to search artworks --}}
    <form class="form" action="/artwork">
    @csrf

        <div class="row ">
            {{-- search by artwork title --}}
            <div class="offset-sm-5 col-sm-2 ">
                <input class="form-control form-control" type="text"
                placeholder="Title" aria-label="Title" name="title">
            </div>

            {{-- search by artwork medium --}}
            <div class="col-sm-2">
                <input class="form-control form-control" type="text"
                placeholder="Medium" aria-label="Medium" name="medium">
            </div>

            {{-- search by artist name --}}
            <div class="col-sm-2">
                <input class="form-control form-control" type="text"
                placeholder="Artist's Name" aria-label="Artist" name="artist">
            </div>

            <div class="col-sm-1">
                <button type="submit" class="btn"><i class="fa fa-search" aria-label="Search" aria-hidden="true"></i> Search</button>
            </div>
        </div>
    </form>

    @component('components.artwork_grid_component', ['artworks' => $artworks]) @endcomponent

</div>

@endsection
