@extends('layouts.app')

@section('title', 'View All Submissions')

@section('content')

<h1 class="text-center">
    @if(count($submissions) > 0)
        {{$submissions[0]->exhibit->title}}
    @else
        No submissions found.
    @endif
</h1><br />

<div class="container">
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

@if(count($submissions) > 0)

    <div class="container">
         {{--  Form to search submissions --}}
    <form class="form" action="/submission/admin/{{ $submissions[0]->exhibit->id }}">
        @csrf
            <div class="row ">
                {{-- search by artist name --}}
                <div class="col-sm-2">
                    <input class="form-control form-control" type="text"
                    placeholder="Artist's Name" aria-label="Artist" name="artist">
                </div>

                {{-- sort by status (accepted or rejected) --}}
                {{-- sort by exhibit type --}}
                <div class="col-sm-2">
                        <select class="custom-select" name="status" aria-label="dropDownSearchBySubmissionStatus">
                            <option value="" selected>All</option>
                            <option value="1">Accepted</option>
                            <option value="0">Rejected</option>
                        </select>
                    </div>
    
                <div class="col-sm-1">
                    <button type="submit" class="btn"><i class="fa fa-search" aria-label="Search" aria-hidden="true"></i> Search</button>
                </div>
            </div>
        </form>

        <div class="row justify-content-end">
            <form action="{{route('submission.all_notify', $submissions[0]->exhibit->id)}}" method="POST" >
                    @csrf
                    @method('PATCH')
                <button type="submit" class="btn btn-success">Notify All</button>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Action</th>
                        <th>Status</th>
                        <th>Notified</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($submissions as $submission)
                        <tr>
                            {{-- First Name --}}
                            <td>{{$submission->user->first_name}}</td>

                            {{-- Last Name --}}
                            <td>{{$submission->user->last_name}}</td>

                            {{-- Email --}}
                            <td><a href="mailto:{{$submission->user->email}}?subject=SVSU%20University%20Art%20Gallery&body=Dear {{$submission->user->first_name}},
                                        %0D%0A  %0D%0A{{$submission->admin_comments}}%0D%0A %0D%0A Sincerely, %0D%0A %0D%0ATisch Lewis">
                                {{$submission->user->username}}@svsu.edu</a></td>

                            {{-- View Button --}}
                            <td><form method="GET" action="{{route('submission.review', $submission->id)}}">
                                <button class="btn btn-primary"type="submit">Review</button> </form></td>

                            {{-- Submission Status --}}
                            <td>
                                @if($submission->status == 0)
                                    Rejected
                                @else
                                    Accepted
                                @endif
                            </td>

                            <td>
                                {{-- notify user form --}}
                                <form action="{{route('submission.notify', $submission)}}" method="POST" >
                                    @csrf
                                    @method('PATCH')

                                    @if($submission->notified)
                                        <button class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i>Notified</button>
                                    @else
                                        <button class="btn btn-secondary">Not Notified</button>
                                    @endif
                                </form>

                            </td>
                        </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="row justify-content-center">
            {{$submissions->links()}}
        </div>

    </div>
@endif
</div>
@endsection
