<div class="grid_component">
    @foreach(array_chunk($submissions->getCollection()->all(), 3) as $row)
        <div class="row"  style="margin-top:20px;">
            @foreach($row as $submission)

                <div class="col-sm-6 col-md-4 d-flex" style="margin-top:10px; margin-bottom:10px;">
                    <div class="card flex-fill card-image-top" style="min-width:250px;">
                        <img class="card-img-top img-fluid"
                            src="{{$submission->exhibit->featured_image_url}}"
                            alt="{{$submission->exhibit->title}}"/>

                        <div class="card-body">
                            <div class="card-title lead"><a href="{{route('submission.show', $submission->id)}}">{{$submission->exhibit->title}}</a></div>
                            <p class="card-text">
                                <span class="text-muted">Submitted:</span> {{date("F j, Y h:i A", strtotime($submission->created_at))}}
                                <br/>
                                <span class="text-muted">Status:</span>
                                @if( $submission->notified == 0)
                                    Pending
                                @else
                                    @if($submission->status == 1)
                                        Invited
                                    @else
                                        Not Invited
                                    @endif
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    @endforeach
</div>
    <div class="row d-flex justify-content-center">
        {{ $submissions->links() }}
    </div>
</div>
