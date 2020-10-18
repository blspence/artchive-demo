@extends('layouts.app')

@section('title', 'Apply to Exhibit')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-blue" style="margin-top:30px;">
            <div class="card-header"><h4 style="padding-top:9px;">Apply to Exhibit</h4></div>
                <div class="card-body">
                    {!! Html::ul($errors->all()) !!}

                    {{-- check if the registration period is closed--}}
                    @if(strtotime($exhibit->registration_end_date_time) < strtotime(date("Y-m-d H:i:s")) )
                        <h1>Oops, the registration period for this exhibit is closed.</h1>
                        <a class="btn btn-primary btn-lg" href="{{ route('exhibit.index') }}">Return to Exhibits Page</a>

                    {{--  check if the registration period is open  --}}
                    @elseif(strtotime($exhibit->registration_start_date_time) > strtotime(date("Y-m-d H:i:s")))
                        <h1>Oops, the registration period for this exhibit does not begin until
                            {{date("F j, Y H:i a", strtotime($exhibit->registration_start_date_time))}}</h1>
                        <div class="row justify-content-center">
                            <a class="btn btn-primary btn-lg" href="{{ route('exhibit.index') }}">Return to Exhibits Page</a>
                        </div>
                    @else
                        {{-- display the submission form --}}
                        {{ Form::open(array('route' => array('submission.store', $exhibit->id),
                                                            'files' => true,
                                                            'method' => 'POST'))}} {{csrf_field()}}
                            <h1>{{$exhibit->title}}</h1>
                            <hr>
                            <p>{{$exhibit->description}}</p>

                            <p>Exhibit Dates: {{date("F j, Y", strtotime($exhibit->start_date_time))}} -
                                {{date("F j, Y", strtotime($exhibit->end_date_time))}}
                            </p>

                            <p>Registration begins on {{date("F j, Y H:i", strtotime($exhibit->registration_start_date_time))}}
                                and ends on {{date("F j, Y H:i", strtotime($exhibit->registration_end_date_time))}}
                            </p>

                            <p><span style="color:red">*</span> Indicates a required field. </p>
                            <hr>
                            {{--if the exhibit is an experimental exhibit, show the appropriate fields. --}}
                            @if($exhibit->type == "EXPERIMENTAL_SPACE_PLAN")
                                <br>
                                @component('components.experimental_submission_fields') @endcomponent
                                <br>
                                <hr>
                                <br>
                                {{--  allow the user to upload a project proposal (basically an artwork with different labels) --}}
                                @component('components.create_experimental_proposal', ['exhibit' => $exhibit]) @endcomponent

                            {{-- let the user add in multiple artworks in a given submission, as long as it isn't an experimental space exhibit --}}
                            @else
                                <div class="float-right" style="margin-right:20px;">
                                    <button type="button" name="add" id="add" class="btn btn-success">Add Another Artwork</button>
                                </div>
                                <br>

                                @component('components.create_artwork', ['exhibit' => $exhibit]) @endcomponent
                            @endif

                            {{-- dynamic field to add a new artwork--}}
                            <div id="dynamic_field"></div>

                            <br><hr><br>
                            {{-- Submission Comments --}}
                            <div class="form-group row">
                                <div class="col-sm-2 text-right">
                                    {{ Form::label('comments', 'Additional Comments') }}
                                </div>
                                <div class="col-sm-10">
                                    {{ Form::textarea('comments', null, array('class' => 'form-control',
                                                                                            'placeholder' => 'Additional Comments',
                                                                                            'rows' => '4' )) }}
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-outline-secondary">Submit</button>
                            </div>
                        {{ Form::close() }}
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

    <script>
        $(document).ready(function(){
            var i=1;
            $('#add').click(function(){
                 i++;
                 $('#dynamic_field').append(
                     '<div id="artwork'+i+'">' +
                         '<br><hr><br>'+
                         '<button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove float-right" style="margin-right:20px;">Remove Artwork</button>' +
                         '<br>' +
                         '<div class="create_artwork_component">'+
                            '<h3>Artwork</h3>'+
                            '<div class="form-group row">'+
                                '<label for="title" class="col-sm-2 col-form-label">Title <span style="color:red">*</span></label>'+
                                '<div class="col-sm-10">'+
                                    '<input type="text" class="form-control" name="title[]" placeholder="Title" required>'+
                                    '<small id="titleHelpBlock" class="form-text text-muted">' +
                                        'Minimum of 3 characters, maximum of 255.' +
                                    '</small>' +
                                '</div>'+
                            '</div>'+

                            '@if($exhibit->type=="ANNUAL_STUDENT_SHOW") '+
                                '<div class="form-group row">'+
                                    '<label for="instructor" class="col-sm-2 col-form-label">Instructor <span style="color:red">*</span></label>'+
                                    '<div class="col-sm-10"> '+
                                        '<input type="text" class="form-control" name="instructor[]" placeholder="Instructor" required>'+
                                        '<small id="instructorHelpBlock" class="form-text text-muted">' +
                                            'Minimum of 3 characters, maximum of 255.' +
                                        '</small>' +
                                    '</div>'+
                                '</div>'+
                                '<div class="form-group row">'+
                                    '<label for="course" class="col-sm-2 col-form-label">Course <span style="color:red">*</span></label>'+
                                    '<div class="col-sm-10"> '+
                                        '<input type="text" class="form-control" name="course[]" placeholder="Course" required>'+
                                        '<small id="courseHelpBlock" class="form-text text-muted">' +
                                            'Minimum of 3 characters, maximum of 255.' +
                                        '</small>' +
                                    '</div>'+
                                '</div>'+
                                '<div class="form-group row"> '+
                                    '<label for="semester" class="col-sm-2 col-form-label">Semester <span style="color:red">*</span></label>'+
                                    '<div class="col-sm-10">'+
                                        '<input type="text" class="form-control" name="semester[]" placeholder="Winter 2019" required> '+
                                        '<small id="semesterHelpBlock" class="form-text text-muted">' +
                                            'Minimum of 3 characters, maximum of 255.' +
                                        '</small>' +
                                    '</div>'+
                                '</div>'+
                            '@endif'+

                            '<div class="form-group row">'+
                                '<label for="medium" class="col-sm-2 col-form-label">Medium <span style="color:red">*</span></label>'+
                                '<div class="col-sm-10">'+
                                    '<input type="text" class="form-control" name="medium[]" placeholder="Medium" required>'+
                                    '<small id="mediumHelpBlock" class="form-text text-muted">' +
                                        'Minimum of 3 characters, maximum of 255.' +
                                    '</small>' +
                                '</div>'+
                            '</div>'+

                            '<div class="form-group row">'+
                                '<label for="description" class="col-sm-2 col-form-label">Description <span style="color:red">*</span></label>'+
                                '<div class="col-sm-10">'+
                                    '<textarea class="form-control" name="description[]" placeholder="Description" rows="4" required></textarea>'+
                                    '<small id="descriptionHelpBlock" class="form-text text-muted">' +
                                        'Minimum of 3 characters, maximum of 255.' +
                                    '</small>' +
                                '</div>'+
                            '</div>'+
                            '<div class="input-group control-group">'+
                                '<label for="submission_photo" class="col-sm-2 col-form-label">Upload Photo <span style="color:red">*</span></label>'+
                                '<div class="col-sm-10"> '+
                                    '<input type="file" name="submission_photo[]" class="form-control" required> '+
                                '</div>'+
                            '</div>'+
                        '</div>' +
                    '</div>');
            });
            $(document).on('click', '.btn_remove', function(){
                 var button_id = $(this).attr("id");
                 $('#artwork'+button_id+'').remove();
            });
        });
    </script>

@endsection
