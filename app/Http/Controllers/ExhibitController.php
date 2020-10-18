<?php

namespace App\Http\Controllers;

use App\Exhibit;
use Illuminate\Http\Request;
use App\Utilities\ImageUtilities;
use App\Http\Requests\ExhibitFormRequest;
use App\Http\Requests\ImageRequiredExhibitFormRules;
use App\Http\Requests\ImageSometimesExhibitFormRules;
use App\Filters\ExhibitFilters;

class ExhibitController extends Controller
{
    // show a list of all exhibits
    public function index()
    {
        $exhibits = Exhibit::
            where('published', '=', true)
            ->orderBy('start_date_time', 'desc')
            ->paginate(4);
        return view('exhibits.index', ['exhibits'=>$exhibits]);
    }

    // form to create a new exhibit
    public function create()
    {
        //pass the default date, today's date at 11:00 AM, to the exhibit page
        $default_date = date('Y-m-d') . "T11:00:00";
        return view('exhibits.create', ["default_date" => $default_date]);
    }

    // return view for admin to manage all exhibits
    public function adminIndex(ExhibitFilters $filters)
    {

        $exhibits = Exhibit::filter($filters)->orderBy('start_date_time', 'desc')->paginate(15);
        return view('exhibits.index-admin', ['exhibits'=>$exhibits]);
    }

    // show a single exhibit
    public function show(Exhibit $exhibit)
    {
        //get the artworks that were featured in a given exhibit, if any
        $artworks = $exhibit->artworks()->where('status', '=', true)->paginate(8);

        //get the users that were featured in an exhibit, if any
        $users = $exhibit->accepted_users_names();

        return view('exhibits.show', compact('exhibit', 'artworks', 'users'));
    }

    /**
     * Store the new exhibit in the database
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validationRules = (new ImageRequiredExhibitFormRules(new ExhibitFormRequest()))->rules();
        $attributes = request()->validate( $validationRules);

        // create an exhibit object
        $exhibit = new Exhibit();

        //set the exhibit type
        $type = $this->get_exhibit_type($attributes['type']);
        $exhibit->type = $type;
        $exhibit->title = $attributes['title'];
        $exhibit->description=$attributes['description'];

        // save the featured image for the exhibit in a folder and store the
        // path url
        if($request->hasfile('featured_image')) {
            $image = $request->file('featured_image');
            $exhibit->featured_image_url = ImageUtilities::store_image($image);
        }
        else {
            $exhibit->featured_image_url = 'https://via.placeholder.com/150';;
        }

        $exhibit->start_date_time = $attributes['start_date_time'];
        $exhibit->end_date_time = $attributes['end_date_time'];
        $exhibit->registration_start_date_time = $attributes['registration_start_date_time'];
        $exhibit->registration_end_date_time = $attributes['registration_end_date_time'];
        $exhibit->reception_start_date_time = $attributes['reception_start_date_time'];
        $exhibit->reception_end_date_time = $attributes['reception_end_date_time'];
        $exhibit->default_accept_message = $attributes['default_accept_message'];
        $exhibit->default_reject_message = $attributes['default_reject_message'];

        //check if the "published" checkbox was selected. If so, update the exhibit's
        //published attribute to be true. Otherwise, set it to false.
        if($request->has('published')){
            if($request['published'] == 'yes'){
                $exhibit->published = true;
            }
            else{
                //if the user tried to change the value of the html form to anything
                //other than "yes", default to false.
                $exhibit->published = false;
            }
        }
        else{
            $exhibit->published = false;
        }

        //save the exhibit to the database
        $exhibit->save();

        return redirect('/admin/exhibit');
    }

    //returns view to edit a single exhibit (the html form)
    public function edit(Exhibit $exhibit){

        return view('exhibits.edit', compact('exhibit'));
    }

    //update an exhibit
    public function update(Request $request, Exhibit $exhibit)
    {
        $validationRules = (new ImageSometimesExhibitFormRules(new ExhibitFormRequest()))->rules();
        $attributes = request()->validate( $validationRules);


        //update the exhibit type
        $type = $this->get_exhibit_type($attributes['type']);
        if($type != -1){
            $exhibit->type = $type;
            $exhibit->update(['type']);
        }

        //update the simple exhibit fields
        $exhibit->update(request([
            'title',
            'description',
            'start_date_time',
            'end_date_time',
            'registration_start_date_time',
            'registration_end_date_time',
            'reception_start_date_time',
            'reception_end_date_time',
            'default_accept_message',
            'default_reject_message'
        ]));

         // update the submission photo, if the user wanted to update it
         if($request->hasfile('featured_image'))
         {
             //delete the old image and save the new image.
             $image = $request->file('featured_image');
             $exhibit->featured_image_url = ImageUtilities::update_image(
                                            $image,
                                            $exhibit->featured_image_url);

             //update the  database
             $exhibit->update(['featured_image_url']);
         }

        //check if the "published" checkbox was selected. If so, update the exhibit's
        //published attribute to be true. Otherwise, set it to false.
        if($request->has('published')){
            if($request['published'] == 'yes'){
                $exhibit->published = true;
            }
            else{
                //if the user tried to change the value of the html form to anything
                //other than "yes", default to false.
                $exhibit->published = false;
            }
        }
        else{
            $exhibit->published = false;
        }

        $exhibit->update(['published']);

        return redirect('/admin/exhibit');
    }

    // delete an exhibit
    public function destroy(Exhibit $exhibit) {
        $exhibit->delete();
        return redirect('/admin/exhibit');
    }

    //private function to return the exhibit's type based on an integer. The value
    //comes from a checkbox on the "create exhibit" or "update exhibit" pages.
    private function get_exhibit_type($type) {
        if($type == 0){
            return"ANNUAL_STUDENT_SHOW";
        }
        else if($type == 1){
            return "BFA_SHOW";
        }
        else if ($type==2){
            return "EXPERIMENTAL_SPACE";
        }
        else if ($type == 3){
            return "EXPERIMENTAL_SPACE_PLAN";
        }
        return -1;
    }
}
