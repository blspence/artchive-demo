@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-11 col-md-8 col-md-offset-2" style="margin-top: 5px">
                @yield('centered_content')
            </div>
        </div>
    </div>
@endsection
