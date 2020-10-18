@extends('layouts.app')

@section('title', 'Accept / Reject Submission')

@section('content')

<div class="container text-center">
    {!! Html::ul($errors->all()) !!}
    {{--  submission   --}}

    <div class="container">
        <div class="justify-content-center">
            <div class="card card-blue" >
                <div class="card-header">
                    <h1 class="text-sm-center">{{$submission->user->first_name}} {{$submission->user->last_name}}'s {{$submission->exhibit->title}} Submission</h1>
                </div>
                <div class="card-body text-left" style="padding:20px;">
                    @component('components.view_submission', ['submission' => $submission]) @endcomponent
                </div>
            </div>
        </div>
    </div>
    {{--  admin accept/reject form  --}}
    <div class="container">
        <div class="justify-content-center">
            <div class="card card-blue" >
                <div class="card-header">
                    <h2 class="text-sm-center">Accept/Reject Submission</h1>
                </div>
                <div class="card-body text-left" style="padding:20px;">

                <form method="POST" action="{{ route('submission.store_review', $submission) }}" method="POST">

                    @method('PATCH')
                    @csrf

                    <div class="form-group row justify-content-center">
                        <div class="col-sm-2 radio">
                            <label for="accept">Accept: </label>
                            <input id="accept" name="status" type="radio" value="1"
                            @if($submission->status == true)
                                checked="checked"
                            @endif >
                        </div>

                        <div class="col-sm-2 radio">
                            <label for="reject">Reject: </label>
                            <input id="reject" name="status" type="radio" value="0"
                                @if(!$submission->status)
                                    checked="checked"
                                @endif >
                        </div>
                    </div>

                    {{--  display the default accept/reject message  --}}
                    <div class="form-group row">
                        <label class="col-sm-1 offset-sm-1 font-weight-bold" for="default_message">
                            Default Message
                        </label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="default_message" rows="4"readonly> @if($submission->status){{$submission->exhibit->default_accept_message}}@else{{$submission->exhibit->default_reject_message}}@endif</textarea>
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-sm-1 offset-sm-1 font-weight-bold">
                            <label for="admin_comments">Additional Comments</label>
                        </div>
                        <div class="col-sm-8">
                            <textarea class="form-control" rows="4" placeholder="Additional Comments" name="admin_comments" id="admin_comments" >{{$submission->admin_comments}}</textarea>
                        </div>
                    </div>

                    <div class="text-center">
                        <input class="btn btn-outline-secondary" type="submit" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row d-flex justify-content-end ">
        <div class="col-auto">
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteSubmissionModal">
                Delete Submission
            </button>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteSubmissionModal" tabindex="-1" role="dialog" aria-labelledby="deleteSubmissionModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="deleteSubmissionModalLabel">Delete Submission</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p>Are you sure that you want to delete the submission?</p>
                <span class="text-danger">Warning: This will delete all artwork associated with the submission.</span>
            </div>
            <div class="modal-footer">
                <div class="modal-footer">
                    <button type="button"
                        class="btn btn-default" data-dismiss="modal">Close</button>
                    <span class="pull-right">
                        <form method="POST" action="{{route('submission.destroy', $submission->id)}}">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <input type="submit" class="btn btn-danger" value="Delete Submission">
                        </form>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
