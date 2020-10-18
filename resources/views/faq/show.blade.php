@extends('layouts.centered_content')

@section('title', 'Frequently Asked Questions')

@section('centered_content')

@card
    @slot('title')
        Frequently Asked Questions
    @endslot

    @slot('body')
        <div id="accordion">
            <div class="card">
                <div>
                    <h2 class="mb-0">
                    <button class="btn btn-lg btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        What are the Bachelor of Fine Arts Exhibition submission requirements?
                    </button>
                    </h2>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="collapseOne" data-parent="#accordion">
                    <div class="card-body">
                        <a href="https://www.svsu.edu/artgallery/bfaexhibitions/ " target="_blank" class="btn btn-primary">View Requirements Here</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div>
                    <h2 class="mb-0">
                    <button class="btn btn-lg btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        What are the Expirimental Space submission requirements?
                    </button>
                    </h2>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="collapseTwo" data-parent="#accordion">
                    <div class="card-body">
                        <a href="https://www.svsu.edu/artgallery/pastexhibitions/winter2018exhibitions/es2018/" target="_blank" class="btn btn-primary">View Requirements Here</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div>
                    <h2 class="mb-0">
                    <button class="btn btn-lg btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        What are the Annual Student Exhibition submission requirements?
                    </button>
                </h2>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="collapseThree" data-parent="#accordion">
                    <div class="card-body">
                        <a href="https://www.svsu.edu/artgallery/annualstudentexhibitions/" target="_blank" class="btn btn-primary">View Requirements Here</a>
                    </div>
                </div>
            </div>
        </div>
    @endslot
@endcard

@endsection