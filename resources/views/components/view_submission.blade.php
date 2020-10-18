{{--  display the experimental space fields  --}}
<div class="container text-left">


        {{-- user name--}}
        <div class="row">
            <div class="col-sm-3 offset-sm-1 font-weight-bold font-weight-bold">Name</div>
            <div class="col-sm-7">
                {{$submission->user->first_name}} {{$submission->user->last_name}}
            </div>
        </div>
        <br>
        {{--user email --}}
        <div class="row">
            <div class="col-sm-3 offset-sm-1 font-weight-bold font-weight-bold">Email</div>
            <div class="col-sm-7">
                {{$submission->user->username}}@svsu.edu
            </div>
        </div>
        <br>

        {{--  display extra fields for Experimental Space Plan submission  --}}
        @if($submission->exhibit->type == "EXPERIMENTAL_SPACE_PLAN")
        {{--  individual student or RSO  --}}
        <div class="row">
            <div class="col-sm-3 offset-sm-1 font-weight-bold font-weight-bold">Applying as RSO or Individual</div>
            <div class="col-sm-7">

                @if($submission->submitable->rso == 1)
                    RSO
                @else
                    Individual Student
                @endif
            </div>
        </div>
        <br>

        {{--  RSO name  --}}
        @if($submission->submitable->rso_name != null)
            <div class="row">
                <div class="col-sm-3 offset-sm-1 font-weight-bold font-weight-bold">RSO Name</div>
                <div class="col-sm-7">{{$submission->submitable->rso_name}}</div>
            </div>
        @endif
        <br>

        {{--  RSO number of participants  --}}
        @if($submission->submitable->rso_num_participants != null)
            <div class="row">
                <div class="col-sm-3 offset-sm-1 font-weight-bold font-weight-bold">RSO Number of Participants</div>
                <div class="col-sm-7">{{$submission->submitable->rso_num_participants}}</div>
            </div>
        @endif
        <br>

        {{--  Faculty adviser --}}
        @if($submission->submitable->rso_name != null)
            <div class="row">
                <div class="col-sm-3 offset-sm-1 font-weight-bold">Faculty Adviser</div>
                <div class="col-sm-7">{{$submission->submitable->faculty_adviser}}</div>
            </div>
        @endif
        <br>

        {{--  Number of  walls --}}
        <div class="row">
            <div class="col-sm-3 offset-sm-1 font-weight-bold">Walls</div>
            <div class="col-sm-7">{{$submission->submitable->walls}}</div>
        </div>
        <br>

        {{--  Number of pedestals--}}
        <div class="row">
            <div class="col-sm-3 offset-sm-1 font-weight-bold">Pedestals</div>
            <div class="col-sm-7">{{$submission->submitable->pedestals}}</div>
        </div>
        <br>

        {{-- brick okay --}}
        <div class="row">
            <div class="col-sm-3 offset-sm-1 font-weight-bold">Brick okay</div>
            <div class="col-sm-7">
                @if($submission->submitable->brick_ok == true)
                    Yes
                @else
                    No
                @endif
            </div>
        </div>
         <br>

        {{-- Additional resources --}}
        <div class="row">
            <div class="col-sm-3 offset-sm-1 font-weight-bold">Additional Resources</div>
            <div class="col-sm-7">{{$submission->submitable->additional_resources}}</div>
        </div>

    @endif

    <br>
    @if($submission->exhibit->type=="EXPERIMENTAL_SPACE_PLAN")
        <h2 class="offset-sm-1 font-weight-bold" >Project Proposal</h2>
    @else
        <h2 class="offset-sm-1 font-weight-bold" >Artwork</h2>
    @endif

    {{--  loop through each of the artworks in the submission, displaying their information  --}}
    @foreach ($submission->artwork as $artwork)

        {{--  artwork photo  --}}
        <div class="row justify-content-center">

                <img class="img-fluid" src="{{$artwork->submission_photo_url}}" alt="{{$artwork->title}} by {{$artwork->user->first_name}} {{$artwork->user->last_name}}">

        </div>

        {{--  artwork title  --}}
        <div class="row">
            <div class="col-sm-3 offset-sm-1 font-weight-bold">Title</div>
            <div class="col-sm-7">{{$artwork->title}}</div>
        </div>

        {{--  artwork medium  --}}
        <div class="row">
            <div class="col-sm-3 offset-sm-1 font-weight-bold">Medium</div>
            <div class="col-sm-7">{{$artwork->medium}}</div>
        </div>

        {{--  artwork description  --}}
        <div class="row">
            <div class="col-sm-3 offset-sm-1 font-weight-bold">Description</div>
            <div class="col-sm-7">{{$artwork->description}}</div>
        </div>

        {{--  line break  --}}
        <div class="row">
            <div class="col-sm-8 offset-sm-1">
                <br><hr><br>
            </div>
        </div>
    @endforeach

    <div class="row">
        <div class="col-sm-3 offset-sm-1 font-weight-bold">Additional Comments</div>
        <div class="col-sm-7">{{$submission->comments}}</div>
    </div>
</div>
