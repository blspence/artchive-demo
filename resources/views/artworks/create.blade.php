{{--
    This page allows the user to create a new artwork object to display on 
    their public profile page that is not associated with a specific exhibit. 
    
    @author: Anna (jcwarric@svsu.edu) 
--}}
@extends('layouts.centered_content')

@section('title', 'Create Artwork')

@section('centered_content')

@card 
    {{-- define the card title --}}
    @slot('title', 'Create Artwork')

    {{-- define the card body --}}
    @slot('body')
        <form method="POST" action="{{ route('artwork.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- Title --}}
            @input([
                'attribute'     => 'title',
                'placeholder'   => 'Title',
                'label'         => 'Title',
                'help_text'     => 'Minimum of 3 characters, maximum of 255.',
                'type'          => 'text',
                'value'         => '',
                'required'      => 'required'
            ])

            {{-- Medium  --}}
            @input([
                'attribute'     => 'medium',
                'placeholder'   => 'Medium',
                'label'         => 'Medium',
                'help_text'     => 'Minimum of 3 characters, maximum of 255.',
                'type'          => 'text',
                'pattern'       => '',
                'value'         => '',
                'required'      => 'required'
            ])

            {{-- Description  --}}
            @textarea([
                'attribute'     => 'description',
                'placeholder'   => 'Description',
                'label'         => 'Description',
                'help_text'     => 'Minimum of 3 characters, maximum of 255.',
                'rows'          => '4', 
                'pattern'       => '',
                'value'         => '',
                'required'      => 'required'
            ])

            {{-- Public Photo Upload --}}
            @input([
                'attribute'     => 'submission_photo',
                'placeholder'   => '',
                'label'         => 'Public Photo',
                'help_text'     => 'Supported image types are jpeg, png, bmp, gif, or svg.',
                'type'          => 'file', 
                'pattern'       => '',
                'value'         => '',
                'required'      => 'required'
            ])

            {{-- Use button include to submit the form --}}
           @button([
               'type'       => 'submit',
               'class'      => 'btn btn-primary',
               'div_class'  => 'col-sm-8 offset-sm-1',
               'href'       => '',
               'text'       => 'Submit'
           ])

        </form>
    @endslot
@endcard
@endsection


