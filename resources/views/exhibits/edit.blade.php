{{--
    This page allows the administrator to edit an existing exhibit.
    
    @author: Anna (jcwarric@svsu.edu) 
--}}
@extends('layouts.app')

@section('title', 'Update Exhibit')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">


<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-blue">
            <div class="card-header">
                <h1 style="padding-top: 9px;">Update Exhibit</h1>
            </div>

            <div class="card-body">
            <form method="POST" action="/exhibit/{{ $exhibit->id }}" enctype="multipart/form-data">

                @method('PATCH')
                @csrf

                <div class="row d-flex justify-content-end ">
                    <div class="col-auto">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteExhibitModal">
                            Delete Exhibit
                        </button>
                    </div>
                </div>

                {{--Exhibit Type --}}
                <div class="form-group row">
                    <label for="radio" class="col-sm-3 col-form-label">Exhibit Type</label>
                    <div class="col-sm-9">
                        <div class="radio">
                            <input id="annualStudentShowType" name="type" type="radio" value="0"
                                @if ($exhibit->type == 'ANNUAL_STUDENT_SHOW')
                                    checked="checked"
                                @endif>
                            <label for="annualStudentShowType">Annual Student Show</label>
                        </div>
                        <div class="radio">
                            <input id="BFAShowType" name="type" type="radio" value="1"
                            @if ($exhibit->type == 'BFA')
                                checked="checked"
                            @endif>
                            <label for="BFAShowType">BFA Show</label>
                        </div>
                        <div class="radio">
                            <input id="experimentalSpaceType" name="type" type="radio" value="2"
                            @if ($exhibit->type == 'EXPERIMENTAL_SPACE')
                                checked="checked"
                            @endif >
                            <label for="experimentalSpaceType">Experimental Space Exhibition</label>
                        </div>
                        <div class="radio">
                            <input id="experimentalSpacePlanType" name="type" type="radio" value="3"
                            @if ($exhibit->type == 'EXPERIMENTAL_SPACE_PLAN')
                                checked="checked"
                            @endif
                            >
                            <label for="experimentalSpacePlanType">Experimental Space Exhibition Plan</label>
                        </div>
                    </div>
                </div>


                <!-- Title -->
                <div class="form-group row">
                    <label for="title" class="col-sm-3 col-form-label">Title</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="title" id="title" placeholder="title"
                        value="{{ $exhibit->title }}" required>
                    </div>
                </div>

                <!-- Description -->
                <div class="form-group row">
                    <label for="description" class="col-sm-3 col-form-label">Description</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="description" id="description" rows="4" required>{{ $exhibit->description }}</textarea>
                    </div>
                </div>

                <!-- Featured Image -->
                <div class="form-group row">
                    <label for="featured_image" class="col-sm-3 col-form-label">Featured Image</label>
                    <div class="col-sm-9">
                        <img class="img-fluid" src="{{$exhibit->featured_image_url}}" alt="{{$exhibit->title}}">
                        <br/><br/>
                        <div class="input-group control-group" >
                        <input type="file" id="featured_image" name="featured_image" class="form-control">
                        </div>
                    </div>
                </div>

                <!-- exhibit start date and time -->
                <div class="form-group row">
                    <label for="start_date_time" class="col-sm-3 col-form-label">Exhibit Start Date and Time</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="datetime-local"  id="start_date_time"
                        name="start_date_time" value="{{ $exhibit->start_date_time }}" required>
                    </div>
                </div>

                <!-- exhibit end date and time -->
                <div class="form-group row">
                    <label for="end_date_time" class="col-sm-3 col-form-label">Exhibit End Date and time</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="datetime-local"  id="end_date_time"
                        name="end_date_time" value="{{ $exhibit->end_date_time }}" required>
                    </div>
                </div>

                  <!-- registration start date and time -->
                  <div class="form-group row">
                    <label for="registration_start_date_time" class="col-sm-3 col-form-label">Registration Start Date and Time</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="datetime-local"  id="registration_start_date_time"
                        name="registration_start_date_time" value="{{ $exhibit->registration_start_date_time }}" required>
                    </div>
                </div>

                  <!-- registration end date and time -->
                  <div class="form-group row">
                    <label for="registration_end_date_time" class="col-sm-3 col-form-label">Registration End Date and Time</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="datetime-local"  id="registration_end_date_time"
                        name="registration_end_date_time" value="{{ $exhibit->registration_end_date_time }}">
                    </div>
                </div>

                  <!-- reception start date and time -->
                  <div class="form-group row">
                    <label for="reception_start_date_time" class="col-sm-3 col-form-label">Reception Start Date and time</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="datetime-local"  id="reception_start_date_time"
                        name="reception_start_date_time" value="{{ $exhibit->reception_start_date_time }}">
                    </div>
                </div>

                  <!-- reception end date and time -->
                  <div class="form-group row">
                    <label for="reception_end_date_time" class="col-sm-3 col-form-label">Reception End Date and time</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="datetime-local"  id="reception_end_date_time"
                        name="reception_end_date_time" value="{{ $exhibit->reception_end_date_time }}">
                    </div>
                </div>


                <!-- Default Accept Submission Message-->
                <div class="form-group row">
                    <label for="default_accept_message" class="col-sm-3 col-form-label">Default Accept Submission Message</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="default_accept_message" name="default_accept_message" placeholder="Message" rows="4" required>{{$exhibit->default_accept_message}}</textarea>
                    </div>
                </div>

                <!-- Default Reject Submission Message-->
                <div class="form-group row">
                    <label for="default_reject_message" class="col-sm-3 col-form-label">Default Reject Submission Message</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="default_reject_message" name="default_reject_message" placeholder="Message" rows="4" required>{{$exhibit->default_reject_message}}</textarea>
                    </div>
                </div>


                <!-- publish exhibit checkbox-->
                <div class="form-group row">
                    <label for="published" class="col-sm-3 col-form-label">Reception End Date and Time</label>
                    <div class="col-sm-9">
                        <input type="checkbox" id="published" name="published" value="yes"
                        @if($exhibit->published == true)
                            checked="checked"
                        @endif >
                        Published
                    </div>
                </div>

                {{-- button to submit changes --}}
               <div class="form-group row justify-content-center">
                    <button type="submit" class="btn btn-primary" style="margin:10px">Update</button>
               </div>

            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteExhibitModal" tabindex="-1" role="dialog" aria-labelledby="deleteExhibitsModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="deleteExhibitsModalLabel">Delete Exhibit</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <p>Are you sure that you want to delete the {{$exhibit->title}}?</p>
        <span class="text-danger">Warning: This will delete all submissions and artwork associated with the exhibit.</span>
      </div>
      <div class="modal-footer">
        <button type="button"
           class="btn btn-default" data-dismiss="modal">Close</button>
        <span class="pull-right">
            <form method="POST" action="{{route('exhibit.destroy', $exhibit->id)}}">
                {{csrf_field()}}
                {{method_field('DELETE')}}
                <input type="submit" class="btn btn-danger" value="Delete Exhibit">
            </form>
        </span>
      </div>
    </div>
  </div>
</div>

@endsection
