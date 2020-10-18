{{--
    This page allows the administrator to create a new exhibit. 
    
    @author: Anna (jcwarric@svsu.edu) 
--}}
@extends('layouts.app')

@section('title', 'Create Exhibit')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">


<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-blue">
            <div class="card-header"><h1 style="padding-top: 9px;">Create Exhibit</h1></div>

            <div class="card-body">
                <form method="post" action="{{ route('exhibit.store') }}" enctype="multipart/form-data">
                {{csrf_field()}}

                {{--Exhibit Type --}}
                <fieldset>
                    <div class="row">
                        <legend class="col-sm-3 col-form-label">Exhibit Type</legend>
                        
                        <div class="col-sm-9" role="radiogroup" aria-labelledby="ExhibitTypeRadioGroup" id="ExhibitTypeRadioGroup">
                            <div class="radio" role="radio" aria-checked="true">
                                <input id="annualStudentShowType" name="type" checked="checked" type="radio" value="0">
                                <label for="annualStudentShowType">Annual Student Show</label>

                            </div>
                            <div class="radio" role="radio" aria-checked="false">
                                <input id="BFAShowType" name="type" type="radio" value="1">
                                <label for="BFAShowType">BFA Show</label>
                            </div>
                            <div class="radio" role="radio" aria-checked="false">
                                <input id="experimentalSpaceType" name="type" type="radio" value="2">
                                <label for="experimentalSpaceType">Experimental Space Exhibition</label>
                            </div>
                            <div class="radio" role="radio" aria-checked="false">
                                <input id="experimentalSpacePlanType" name="type" type="radio" value="3">
                                <label for="experimentalSpacePlanType">Experimental Space Exhibition Plan</label>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <!-- Title -->
                <div class="form-group row">
                    <label for="title" class="col-sm-3 col-form-label">Title</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="title" id="title" placeholder="Title" required>
                    </div>
                </div>

                <!-- Description -->
                <div class="form-group row">
                    <label for="description" class="col-sm-3 col-form-label">Description</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="description" id="description" placeholder="Description" rows="4" required></textarea>
                    </div>
                </div>

                <!-- Featured Image -->
                <div class="form-group row">
                    <label for="featured_image" class="col-sm-3 col-form-label">Featured Image</label>

                    <div class="col-sm-9">
                        <input id="featured_image" name="featured_image" type="file"
                        class="form-control{{ $errors->has('featured_image') ? ' is-invalid' : '' }}">

                        @if ($errors->has('featured_image'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('featured_image') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <!-- exhibit start date and time -->
                <div class="form-group row">
                    <label for="start_date_time" class="col-sm-3 col-form-label">Exhibit Start Date and Time</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="datetime-local" value="{{$default_date}}" id="start_date_time"
                        name="start_date_time" required>
                    </div>
                </div>

                <!-- exhibit end date and time -->
                <div class="form-group row">
                    <label for="end_date_time" class="col-sm-3 col-form-label">Exhibit End Date and Time</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="datetime-local" value="{{$default_date}}" id="end_date_time"
                        name="end_date_time" required>
                    </div>
                </div>

                  <!-- registration start date and time -->
                  <div class="form-group row">
                    <label for="registration_start_date_time" class="col-sm-3 col-form-label">Registration Start Date and Time</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="datetime-local" value="{{$default_date}}" id="registration_start_date_time"
                        name="registration_start_date_time" required>
                    </div>
                </div>

                  <!-- registration end date and time -->
                  <div class="form-group row">
                    <label for="registration_end_date_time" class="col-sm-3 col-form-label">Registration End Date and Time</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="datetime-local" value="{{$default_date}}" id="registration_end_date_time"
                        name="registration_end_date_time" required>
                    </div>
                </div>

                  <!-- reception start date and time -->
                  <div class="form-group row">
                    <label for="reception_start_date_time" class="col-sm-3 col-form-label">Reception Start Date and Time</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="datetime-local" value="{{$default_date}}" id="reception_start_date_time"
                        name="reception_start_date_time">
                    </div>
                </div>

                  <!-- reception end date and time -->
                  <div class="form-group row">
                    <label for="reception_end_date_time" class="col-sm-3 col-form-label">Reception End Date and Time</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="datetime-local" value="{{$default_date}}" id="reception_end_date_time"
                        name="reception_end_date_time">
                    </div>
                </div>

                <!-- Default Accept Submission Message-->
                <div class="form-group row">
                    <label for="default_accept_message" class="col-sm-3 col-form-label">Default Accept Submission Message</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="default_accept_message" name="default_accept_message" placeholder="Message" rows="4" required></textarea>
                    </div>
                </div>

                <!-- Default Reject Submission Message-->
                <div class="form-group row">
                    <label for="default_reject_message" class="col-sm-3 col-form-label">Default Reject Submission Message</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="default_reject_message" name="default_reject_message" placeholder="Message" rows="4" required></textarea>
                    </div>
                </div>

                <!-- publish exhibit checkbox-->
                <div class="form-group row">
                    <label for="published" class="col-sm-3 col-form-label">Reception End Date and Time</label>
                    <div class="col-sm-9">
                        <input type="checkbox" checked="checked" id="published" name="published"  value="yes"> Publish Immediately
                    </div>
                </div>


                <button type="submit" class="btn btn-primary" style="margin-top:10px">Submit</button>

            </form>
        </div>
    </div>
</div>

@endsection
