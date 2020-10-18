@extends('layouts.app')

@section('title', 'View Exhibits')

@section('content')
<div class="container" >
    <h1 class="text-center">University Art Department Gallery Exhibits</h1>
@if(count($exhibits) > 0)
    <?php $counter = 0; ?>
    @foreach($exhibits as $exhibit)

        <div class="card exhibit">
            <div class="card-body" style="padding:0;">
                <div class="form-inline">
                    <div class="col-lg-7
                        @if(++$counter % 2 === 0)
                            order-lg-last
                        @endif" style="padding:0">
                        <img class="img-fluid" style="width: 100%;" src="{{$exhibit->featured_image_url}}" alt="{{$exhibit->title}}">
                    </div>
                    <div class="col-lg-5 text-center">
                        <h3 class="text-center title">{{$exhibit->title}}</h3>
                        <p>
                            <!-- cut off description after 200 chars, at the nearest space, and add "..." -->
                            @if(strlen($exhibit->description)>170){{substr($exhibit->description, 0,strpos($exhibit->description, ' ', 170))}}...@endif
                        </p>
                        <p> {{date("F j, Y", strtotime($exhibit->start_date_time))}} -
                            {{date("F j, Y", strtotime($exhibit->end_date_time))}}
                        </p>
                        <a class="col-sm-12" href="/exhibit/{{$exhibit->id}}">View Exhibit</a>
                        <a class="col-sm-12" href="{{ route('submission.create', $exhibit->id ) }}">Apply to Exhibit</a>
                    </div>
                </div>
            </div>

        </div>
    <br />
    @endforeach

     <div class="row d-flex justify-content-center" style="margin-top:20px;">
        {{ $exhibits->links()}}
    </div>
@endif
</div>

@endsection

