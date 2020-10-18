<?php

namespace App\Http\Controllers;

use App\Artwork;
use Illuminate\Http\Request;
use App\Utilities\ImageUtilities;
use App\Http\Requests\ArtworkFormRequest;
use App\Filters\ArtworkFilters;
use Carbon\Carbon;


class ArtworkController extends Controller
{
    /**
     * show all artwork
     */
    public function index(ArtworkFilters $filters)
    {
        $artworks = Artwork::filter($filters)
        ->where('public_photo_url', '<>',  "")
        ->orderBy('created_at', 'desc')
        ->paginate(8);
        return view('artworks.index', ['artworks'=>$artworks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('artworks.create');
    }

        /**
     * Show  the page for a single artwork
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Artwork $artwork)
    {

        return view('artworks.show', ['artwork' => $artwork]);
    }

    /**
     * Store the new artwork in the database
     *  @todo: better submission placeholder or N/A image
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = request()->validate(ArtworkFormRequest::rules());

        $artwork = new Artwork();
        $artwork->user_id = $request->user()->id;
        $artwork->medium = $attributes['medium'];
        $artwork->description = $attributes['description'];
        $artwork->title = $attributes['title'];

        //if the artwork is from the Annual Student Show, then it will also have
        //an instructor, semester, and course. For now, we're just appending these
        //attributes to the description because we only use them for display
        //purposes alongside the description.
        if( array_key_exists("instructor", $attributes) &&
            array_key_exists("semester", $attributes)   &&
            array_key_exists("course", $attributes)     )
        {
            $artwork->description = $artwork->description . "\n"
            . "This artwork was created in the " . $attributes['course'] . "course,"
            . "taught by " . $attributes['instructor'] . " in the "
            . $attributes['semester'] . " semester. ";
        }

        // if the user submitted a photo with their submission, save it and store
        // the image url. Otherwise, store a placeholder image url.
        if($request->hasfile('submission_photo'))
        {
            $image = $request->file('submission_photo');
            $artwork->submission_photo_url = ImageUtilities::store_image($image);
        }
        else
        {
            $artwork->submission_photo_url = 'https://via.placeholder.com/150';
        }

        // check to see if the artwork is being stored as a part of a submission or
        // to be displayed on the artist's profile (not part of any submission)
        if($request->has('submission_id')){
            // if the artwork is part of a submission, save the id and set the
            // public photo to null, to be updated later by the archivist
            $artwork->submission_id = $request['submission_id'];
            $artwork->public_photo_url = "";
        }
        else{
            //if the artwork is not part of a submission, set its submission id
            //to null and let the submission photo (ie the photo that the user uploaded)
            //be the public photo
            $artwork->submission_id = null;
            $artwork->public_photo_url = $artwork->submission_photo_url;
        }

        //save the current timestamp
        $artwork->created_at = Carbon::now();

        // save the artwork to the database
        $artwork->save();
        $profile = $request->user()->id;

        return redirect(route('profile.show', $profile));
    }

    // returns view to edit a single artwork (the html form)
    public function edit(Artwork $artwork)
    {
        return view('artworks.edit', compact('artwork'));
    }

    // update an artwork in the databse, TODO: NEED TO VALIDATE?
    public function update(Request $request, Artwork $artwork)
    {
        $artwork->update(request(['title', 'medium', 'description']));

        // update the submission photo, if the user wanted to update it
        if($request->hasfile('submission_photo'))
        {
            // delete the old image and save the new image
            $image = $request->file('submission_photo');
            $artwork->submission_photo_url = ImageUtilities::update_image(
                $image,
                $artwork->submission_photo_url);

            // update the  database
            $artwork->update(['submission_photo_url']);
        }

        // update the archivist photo, if the user wanted to update it
        if($request->hasfile('public_photo'))
        {
            //delete the old image and save the new image.
            $image = $request->file('public_photo');

            //if the public photo already exists, replace it with the new image.
            if($artwork->public_photo_url != null){
                $artwork->public_photo_url = ImageUtilities::update_image(
                                                $image,
                                                $artwork->public_photo_url);
            }
            else{
                $artwork->public_photo_url = ImageUtilities::store_image($image);
            }

            // update the  database
            $artwork->update(['public_photo_url']);
        }

        return redirect('/artwork');
    }

    // delete an artwork (will need to handle foreign keys)
    public function destroy(Artwork $artwork)
    {
        if($artwork->submission_id == null){
            $artwork->delete();
        }
        else{
            return back()->withErrors("Error, you can't delete this artwork because it is part of an exhibit.");
        }
        return redirect(route('artwork.index'));
    }

    public function store_many(Request $request, int $submission_id){

        $attributes = request()->validate(ArtworkFormRequest::rules_many());

        //loop through the arrays for each field, storing each Artwork's attributes
        //in an artwork object.
        $submission_photos = $attributes['submission_photo'];
        foreach($attributes['title'] as $key=>$title){
            $artwork= new Artwork();
            $artwork->user_id = $request->user()->id;
            $artwork->submission_id = $submission_id;

            $artwork->medium = $attributes['medium'][$key];
            $artwork->description = $attributes['description'][$key];
            $artwork->title = $attributes['title'][$key];

            //if the artwork is from the Annual Student Show, then it will also have
            //an instructor, semester, and course. For now, we're just appending these
            //attributes to the description because we only use them for display
            //purposes alongside the description.

            if( array_key_exists("instructor", $attributes) &&
                array_key_exists("semester", $attributes)   &&
                array_key_exists("course", $attributes)     )
            {

                $artwork->description = $artwork->description . "\n"
                . "This artwork was created in the " . $attributes['course'][$key] . " course, "
                . "taught by " . $attributes['instructor'][$key] . " in the "
                . $attributes['semester'][$key] . " semester. ";
            }


            // if the user submitted a photo with their submission, save it and store
            // the image url. Otherwise, store a placeholder image url.

            /**  @todo: if submission_photo is null, indexes will be off!!*/
            if($submission_photos[$key] != null)
            {
                $image = $submission_photos[$key];
                $artwork->submission_photo_url = ImageUtilities::store_image($image);
            }
            else
            {
                $artwork->submission_photo_url = 'https://via.placeholder.com/150';
            }

            // when an artwork is initially submitted, it won't have an archivist photo yet.
            $artwork->public_photo_url = "";

            $artwork->created_at = Carbon::now();

            // save the artwork to the database
            $artwork->save();
        }

        return;
    }
}
