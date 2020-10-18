{{--
    This page allows the user to edit or delete on of their artworks.
    
    @author: Anna (jcwarric@svsu.edu) 
--}}
@extends('layouts.centered_content')

@section('title', 'Update Artwork')

@section('centered_content')

@card 
    {{-- define the card title --}}
    @slot('title', 'Update Artwork')

    {{-- define the card body --}}
    @slot('body')
        <form method="POST"  action="/artwork/{{ $artwork->id }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            {{-- Title --}}
            @input([
                'attribute'     => 'title',
                'placeholder'   => 'Title',
                'label'         => 'Title',
                'help_text'     => 'Minimum of 3 characters, maximum of 255.',
                'type'          => 'text',
                'value'         => $artwork->title,
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
                'value'         => $artwork->medium,
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
                'value'         => $artwork->description,
                'required'      => 'required'
            ])

            
            {{--  display the current public (archivist) photo--}}
            <div class="row">
                <div class="col-sm-4 text-md-right">
                    <strong>Public Photo</strong>
                </div>
               
                <div class="col-sm-8">
                    <img class="img-fluid" src="{{$artwork->public_photo_url}}" alt="{{$artwork->title}}">
                </div>
            </div>
            <br>

            {{-- field to update the public (archivist) photo --}}
            <div class="form-group row align-items-center">
                <div class="col-sm-4 text-md-right">
                    <label for="public_photo"><strong>Change public photo</strong></label>
                </div>
                <div class="col-sm-8 control-group input-group">
                    <input type="file" id="public_photo" name="public_photo" class="form-control">
                </div>
            </div>
            
            {{-- Use button include to submit the form --}}
           @button([
               'type'       => 'submit',
               'class'      => 'btn btn-primary',
               'div_class'  => 'col-sm-8 offset-sm-1',
               'href'       => '',
               'text'       => 'Submit'
           ])

        </form>

        {{-- button to delete an artwork --}}
        <div class="col-sm-1 offset-md-6">
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteArtworkModal">
                Delete
            </button>
        </div>

    @endslot
@endcard

{{-- "Are you sure that you want to delete this artwork?" modal --}}
<div class="modal fade" id="deleteArtworkModal" tabindex="-1" role="dialog" aria-labelledby="deleteArtworkModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="deleteArtworkModalLabel">Delete Artwork</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p>Are you sure that you want to delete the artwork?</p>
            </div>
            <div class="modal-footer">
                <button type="button"
                    class="btn btn-default" data-dismiss="modal">Close</button>
                <span class="pull-right">
                    <form method="POST" action="{{route('artwork.destroy', $artwork->id)}}">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <input type="submit" class="btn btn-danger" value="Delete">
                    </form>
                </span>
            </div>
        </div>
    </div>
</div>
@endsection

