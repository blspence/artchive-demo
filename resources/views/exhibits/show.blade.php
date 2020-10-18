{{--
    This page allows a user to view the details of a particular exhibit. 
    
    @author: Anna (jcwarric@svsu.edu) 
--}}
@extends('layouts.app')

@section('title', 'Exhibit')

@section('content')
<div class="container">
    <div class="justify-content-center">
        <div class="card card-blue">
            <div class="card-header justify-content-center">
                <h1 class="text-sm-center">{{$exhibit->title}}</h1>
            </div>
            <div class="card-body">
                <!--Display featured image-->
                <div class="row justify-content-center">
                    <div class="col-sm-10">
                        <img class="img-fluid" src="{{$exhibit->featured_image_url}}" alt="{{$exhibit->title}}"/>
                    </div>
                </div>
                <br>

                <!--exhibit dates-->
                <div class="row justify-content-center">
                    <div class="col-sm-10">
                        <p>Exhibit runs from: {{date("F j, Y", strtotime($exhibit->start_date_time))}} -
                        {{date("F j, Y", strtotime($exhibit->end_date_time))}}
                        </p>
                    </div>
                </div>

                <!--registration dates-->
                <div class="row justify-content-center">
                    <div class="col-sm-10">
                        <p>The registration period begins on
                            {{date("F j, Y h:i A", strtotime($exhibit->registration_start_date_time))}}
                            and ends on
                            {{date("F j, Y h:i A", strtotime($exhibit->registration_end_date_time))}}
                        </p>
                    </div>
                </div>

                <!--reception dates-->
                <div class="row justify-content-center">
                    <div class="col-sm-10">
                        <p>The reception will be held on {{date("F j, Y", strtotime($exhibit->start_date_time))}} from
                        {{date("h:i A", strtotime($exhibit->reception_start_date_time))}} to
                        {{date("h:i A", strtotime($exhibit->reception_end_date_time))}}
                        </p>
                    </div>
                </div>

                <!-- description -->
                <div class="row justify-content-center">
                    <div class="col-sm-10">
                        <p>{{$exhibit->description}}</p>
                    </div>
                </div>
                <br/>

                <!--featured artists (users) -->
                <div class="row justify-content-center">
                        <div class="col-sm-10">
                            <!--format the text displayed if there was only one artist in the show-->
                            @if(count($users) == 1)
                                <p>This exhibit features artwork by
                                    <a href=" {{ route('profile.show', $users[0]->id) }}">
                                        {{$users[0]->first_name}} {{$users[0]->last_name}}</a>.
                                </p>
                            <!--format the text displayed if there was more than one artist in the show-->
                            @elseif(count($users) > 0)
                                <p>Participating student artists include:
                                    @foreach($users as $user)
                                    @if ($loop->last)
                                        and <a href=" {{ route('profile.show', $user->id) }}">{{$user->first_name}} {{$user->last_name}}</a>.
                                    @else
                                        <a href=" {{ route('profile.show', $user->id) }}">{{$user->first_name}} {{$user->last_name}}</a>,
                                    @endif
                                    @endforeach
                                </p>
                            @endif
                        </div>
                    </div>

                <!--featured artworks -->
                <div class="row justify-content-center">
                    <div class="col-sm-10">
                        @if(count($artworks) > 0)
                            <h2> Featured Artworks </h2>
                            @component('components.artwork_grid_component', ['artworks' => $artworks]) @endcomponent
                        @endif
                    </div>
                </div>

                <!--disclaimer-->
                <div class="row justify-content-center">
                    <div class="col-sm-10">
                        <p>All gallery exhibitions, lectures and receptions are free
                            and open to the public. Visit the 
                            <a href="https://www.svsu.edu/artgallery/" target="_blank">gallery website</a> for open
                            hours or call (989) 964-2291. The University Art
                            Gallery is located in the Arbury Fine Arts Center on the
                            campus of Saginaw Valley State University.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
