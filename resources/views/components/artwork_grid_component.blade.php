{{--
    This component displays a grid of artwork cards. It takes in an array of
    paginated artwork objects. This component is used on the artworks.index page,
    and on the users's profile page.

    @author Anna (jcwarric@svsu.edu)
--}}
<div class="grid_component">

    {{-- display each chunk of 4 artworks in their own row --}}
    @foreach(array_chunk($artworks->getCollection()->all(), 4) as $row)
        <div class="row"  style="margin-top:20px;">
            @foreach($row as $artwork)
                {{-- display the artwork's public photo --}}
                @if($artwork->public_photo_url != null)
                    <div class="col-sm-6 col-md-3 d-flex" style="margin-top:10px; margin-bottom:10px;">
                        <div class="card flex-fill card-image-top" style="min-width:200px;">
                            <img class="card-img-top img-fluid"
                                src="{{$artwork->public_photo_url}}"
                                alt="{{$artwork->title}} by {{$artwork->user->first_name}} {{$artwork->user->last_name}}"/>

                            <div class="card-body">
                                {{-- display the artwork's title with a link to the individual artwork's page --}}
                                <div class="card-title lead"><a href="{{route('artwork.show', $artwork->id)}}" title="View Artwork">{{ $artwork->title }}</a></div>

                                {{-- display the artist's name with a link to his/her profile --}}
                                <div class="card-subtitle mb-2 text-muted">
                                    Artist: <a href="{{route('profile.show', $artwork->user)}}" title="View Artist Profile">
                                    {{$artwork->user->first_name}} {{$artwork->user->last_name}}</a>
                                </div>

                                {{-- display the artwork's information (medium and description) --}}
                                <p class="card-text">
                                    <span class="text-muted">Medium:</span> {{ $artwork->medium }}
                                    <br>
                                    <span class="text-muted">Description:</span> {{ substr($artwork->description, 0, 200 )}}...
                                </p>

                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @endforeach
</div>
    <div class="row d-flex justify-content-center">
        {{ $artworks->appends($_GET)->links() }}
    </div>
</div>
