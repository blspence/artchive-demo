{{--
    This page allows the administrator to manage the exhibits. It displays a table
    of all of the exhibits and allows the admin to select links to view the exhibit,
    view the submissions for an exhibit, update an exhibit, or create a new
    exhibit. 
    
    @author: Anna (jcwarric@svsu.edu) 
--}}
@extends('layouts.app')

@section('title', 'View Exhibits')

@section('content')

    @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div><br />
    @endif
    <div class="container-fluid col-sm-9" style="padding:50px;">
        <div >
            <h1>Manage Exhibits</h3>
        </div>
         {{--  Search form  for admin to search exhibits by title or type. --}}
    <form class="form" action="{{route('exhibit.adminIndex')}}">
        @csrf
            <div class="row ">
                {{-- button to create a new exhibit --}}
                <div class="col-sm-2">
                    <a href="/exhibit/create" class="btn btn-primary"
                    style="margin-right:100px;margin-bottom:10px;"> + Create a new exhibit</a>
                </div>

                {{-- search by exhibit title --}}
                <div class="offset-sm-5 col-sm-2 ">
                    <input class="form-control form-control" type="text"
                    placeholder="Title" aria-label="Title" name="title">
                </div>

                {{-- sort by exhibit type --}}
                <div class="col-sm-2">
                    <select class="custom-select" name="type" aria-label="dropDownSearchByExhibitType">
                        <option value="" selected>All</option>
                        <option value="EXPERIMENTAL_SPACE">Experimental Space</option>
                        <option value="ANNUAL_STUDENT_SHOW">Annual Student Show</option>
                        <option value="BFA">BFA Show</option>
                        <option value="EXPERIMENTAL_SPACE_PLAN">Experimental Space Plan</option>
                    </select>
                </div>

                <div class="col-sm-1">
                    <button type="submit" class="btn"><i class="fa fa-search" aria-hidden="true"></i> search</button>
                </div>
            </div>
        </form>

        {{-- Table to display exhibit details --}}
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
                            src="{{$exhibit->featured_image_url}}"
                            alt="{{$exhibit->title}}"/>
                        </td>
                        <td>{{$exhibit->title}}</td>
                        <td>{{date("F j, Y", strtotime($exhibit->start_date_time))}} </td>
                        <td>{{date("F j, Y", strtotime($exhibit->end_date_time))}} </td>

                        <td>
                            <a href="{{ route('submission.index', $exhibit->id) }}">Submissions</a>
                            <br>
                            <a href="/exhibit/{{$exhibit->id}}" >View Exhibit</a>
                            <br>
                            <a href="/exhibit/{{$exhibit->id}}/edit">Update Exhibit</a>
                            
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
