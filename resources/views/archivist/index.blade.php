{{--
    @author: Anna (jcwarric@svsu.edu)

    The archivist's index page allows an archivst to view a list of all of the exhibits
    and select one to upload photos to.
--}}
@extends('layouts.app')

@section('title', 'View Exhibits')

@section('content')

    @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        <br />
    @endif

    <div class="container-fluid col-sm-9" style="padding:50px;">
    
    <form class="form" action="{{route('exhibit.adminIndex')}}">
        @csrf
            <div class="row ">
                <div class="col-sm-3" >
                    <h1>Exhibits</h1>
                </div>
                <div class="offset-sm-4 col-sm-2 ">
                    <input class="form-control form-control" type="text"
                    placeholder="Title" aria-label="Title" name="title">
                </div>

                <div class="col-sm-2">
                    <select class="custom-select" name="type" aria-label="Exhibit">
                        <option value="" selected>All</option>
                        <option value="EXPERIMENTAL_SPACE">Experimental Space</option>
                        <option value="ANNUAL_STUDENT_SHOW">Annual Student Show</option>
                        <option value="BFA">BFA Show</option>
                    </select>
                </div>

                <div class="col-sm-1">
                    <button type="submit" class="btn" aria-label="search"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                </div>
            </div>
        </form>
        <br>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>Index</td>
                        <td>Image</td>
                        <td>Title</td>
                        <td>Start Date</td>
                        <td>End Date</td>
                        <td>Actions</td>
                    </tr>
                </thead>
            <tbody>

                    @foreach($exhibits as $exhibit)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>
                            <img class="img-fluid" style="width:100px;height:100px;"
                            src="{{$exhibit->featured_image_url}}" alt="{{$exhibit->title}}"/>
                        </td>
                        <td>{{$exhibit->title}}</td>
                        <td>{{date("F j, Y", strtotime($exhibit->start_date_time))}} </td>
                        <td>{{date("F j, Y", strtotime($exhibit->end_date_time))}} </td>

                        <td>
                            <a class="btn btn-primary" href="{{route('archivist.update', $exhibit->id)}}">Upload Photos </a>
                        </td>
                    </tr>
                    @endforeach
            </tbody>
            </table>
        </div>
        <div class="row d-flex justify-content-center">
                {{ $exhibits->links()}}
        </div>

    </div>

@endsection
