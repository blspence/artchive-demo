<div class="card card-blue">
    <div class="card-header">
        <div class="containter">
            <div class="row">
                <div class="col-sm-8">
                    <h1> {{ $title }} </h1>
                </div>

                @auth
                    @if(!@empty($button))
                        <div class="col-sm-4">
                            <td><a href="{{ route($route, $object) }}" class="btn btn-light float-right">
                                {{ $button_text }}</a></td>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="col-sm-10 justify-content-center">
            {{ $body }}
        </div>
    </div>
</div>
