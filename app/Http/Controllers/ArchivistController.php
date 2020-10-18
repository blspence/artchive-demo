<?php

namespace App\Http\Controllers;

use App\Exhibit;
use App\Artwork;
use App\Submission;
use Illuminate\Http\Request;
use App\Utilities\ImageUtilities;
use App\Http\Requests\ArtworkFormRequest;
use Illuminate\Support\Facades\Storage;

class ArchivistController extends Controller
{
    /**
     * Display a listing of the various exhibits that the archivist can
     * add photos to.
     *
     * @return Response
     */
    public function index()
    {
        $exhibits = Exhibit::
        where('published', '=', true)
        ->orderBy('start_date_time', 'desc')
        ->paginate(10);
        return view('archivist.index', ['exhibits'=>$exhibits]);

    }

    /**
     * Show the management table for uploading professional photos to the
     * artwork in a particular exhibit.
     *
     * @return Response
     */
    public function show(Exhibit $exhibit)
    {
        // $artworks = $exhibit->artworks()->where('accepted', '=', 'true')->get();
        $artworks = $exhibit->accepted_artworks()->paginate(8);
        return view('archivist.show', compact('artworks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the artwork's professional (archivist) photo.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the artwork's professional (archivist) photo in storage.
     *
     * @param  Request $request: the request, usually from the 'archivist-upload-photos' page
     * @param  Artwork $artwork : the artwork object being updated
     * @return Response redirects to the 'archivist-upload-photos' page.
     */
    public function update(Request $request, Artwork $artwork)
    {

        // Storage::delete("public/images/x5UZEW1mN0e40pCp6YHinoOHfQ4BChAA5ftkMPsj.png");
        // Storage::delete("public/images/rHGX6G3GRgVHqHb4145y71U7A0OVpYyWUMBovelH.png");
        // dd($artwork->public_photo_url);
        $attributes = request()->validate(ArtworkFormRequest::archivist_rules());

        //if the archivist chose to allow the public photo to be the student's
        //submission photo, set the artwork's public photo to the submission
        //photo.
        if($request->has('use_submission_photo')){
           //if the archivist uploaded their own photo and then decided go back
           //to using the student's submission photo as public, then
           //delete the archivist's photo from the images folder before updating
           //the public photo url.
            if($artwork->public_photo_url != null &&
                $artwork->public_photo_url != $artwork->submission_photo_url){
                    ImageUtilities::remove_image($artwork->public_photo_url);
            }
            $artwork->public_photo_url = $artwork->submission_photo_url;
        }
        // otherwise, update the archivist photo, if the user wanted to update it
        else if($request->hasfile('archivist_photo'))
        {
            $image = $request->file('archivist_photo');

            //if the public photo is currently set to the user's submission photo
            //or the public photo is null, upload the artchivist photo and save the path
            if( $artwork->public_photo_url == null ||
                $artwork->public_photo_url == $artwork->submission_photo_url)
            {
                    $artwork->public_photo_url = ImageUtilities::store_image($image);
            }
            // otherwise, delete the old image and save the new image
           else
           {
                $artwork->public_photo_url = ImageUtilities::update_image(
                    $image,
                    $artwork->public_photo_url);
            }

        }

        $artwork->update(['public_photo_url']);
        return  redirect()->back();

    }
}
