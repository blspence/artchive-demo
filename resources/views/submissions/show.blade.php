@extends('layouts.app')

@section('title', 'Individual Submission')

@section('content')

    {{--  card to show the user his/her application status  --}}
    <div class="container">
        <div class="justify-content-center">
            <div class="card card-blue" >
                <div class="card-header">
                    <h1 class="text-sm-center">Submission Status</h1>
                </div>
                <div class="card-body text-left" style="padding:20px;">
                    <div class="container text-left">
                        <div class="row">
                            <div class="col-10 offset-sm-1">
                                {{--  if the user has been notified, show their submission status along with the default accept/reject comments
                                    for the exhibit and the admin's additional comments, if any. Otherwise, display "Pending"  --}}
                                @if($submission->notified)

                                    @if($submission->status == 1)
                                        <h2>Invited!</h2>
                                        <p>{{$submission->exhibit->default_accept_message}} {{$submission->admin_comments}}</p>
                                    @else
                                        <h2>Not Invited</h2>
                                        <p>{{$submission->exhibit->default_reject_message}} {{$submission->admin_comments}}</p>
                                    @endif
                                @else
                                    <h2>Pending</h2>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--  show the users's submission details  --}}
<div class="container">
    <div class="justify-content-center">
        <div class="card card-blue" >
            <div class="card-header">
                <h1 class="text-sm-center">{{$submission->user->first_name}} {{$submission->user->last_name}}'s {{$submission->exhibit->title}} Submission</h1>
            </div>
            <div class="card-body text-left" style="padding:20px;">
                {{--  this component can be found in components/view_submission  --}}
                @component('components.view_submission', ['submission' => $submission]) @endcomponent
            </div>
        </div>
    </div>
</div>

@endsection
