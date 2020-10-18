<?php

namespace App\Http\Controllers;

use View;
use App\User;
use App\Exhibit;
use App\Artwork;
use App\Submission;
use App\ExperimentalSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\SubmissionFormRequest;
use App\Http\Requests\ArtworkFormRequest;
use App\Filters\SubmissionFilters;

class SubmissionController extends Controller
{
    /**
     * Create a new controller instance and associate all
     * functions in this controller with the 'auth' middleware.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Displays a listing of all submissions in the database.
     *
     * @return Response
     */
    public function index(Exhibit $exhibit, SubmissionFilters $filters)
    {
        $submissions = Submission::filter($filters)
        ->where('exhibit_id', "=", $exhibit->id)
        ->paginate(10);
        
        return view('submissions.index')->with(['submissions' => $submissions]);
    }

    /**
     * Displays a view to show one submission.
     *
     * @param Submission $id
     * @return Response
     */
    public function show($id)
    {
      return view('submissions.show')->with(['submission'=>Submission::find($id)]);
    }

    /**
     * Updates the given submission in the database.
     *
     * @param Submission $id
     * @return Response
     */
    public function store_review(Submission $submission, Request $request)
    {
        $rules = array(
            'status' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails())
        {
            return Redirect::to('submission/' . $submission->id . '/review')
                ->withErrors($validator)
                ->withInput(Input::all());
        }
        else
        {

            $submission->status = Input::get('status');
            if(Input::has('admin_comments')){
                $submission->admin_comments = Input::get('admin_comments');
            }
            $submission->save();
            return redirect()->route('submission.index', $submission->exhibit_id);
        }
    }

    /**
     * shows the form for the admin to review (accept or reject) the given submission
     */
    public function review(Submission $submission){
        return view('submissions.review', compact('submission'));
    }

    /**
     * Shows the form for creating a new submission.
     *
     * @param Request $request
     * @param Exhibit $id
     * @return Response
     */
    public function create(Request $request, $id)
    {
        $exhibit = Exhibit::find($id);
        $submission = new Submission();

        return View::make('submissions.create', array('exhibit' => $exhibit, 'submission' => $submission));
    }

    /**
     * Stores a new submission and associated artwork in the database.
     *
     * @param int $id (of Submission)
     * @param int $exhibit_id
     * @return Response
     *
     *
     * TODO: have 2 artwork options that say "Add another artwork with Photo/add another artwork without photo"?
     * or something cleaner?, for now ignoring the issue of non-required artwork photos to make progress elsewhere
     *
     * or hidden input of ids of artworks that have a photo or ??
     */
    public function store(Request $request)
    {
        $exhibit_id = basename(request()->path());
        $exhibit = Exhibit::find($exhibit_id);

        if($exhibit->type == "EXPERIMENTAL_SPACE_PLAN"){
            $validator = Validator::make(Input::all(), SubmissionFormRequest::experimental_rules());
        }
        else{
            $validator = Validator::make(Input::all(), SubmissionFormRequest::rules());
        }
        if ($validator->fails())
        {
            return Redirect::to(route('submission.create', $exhibit_id))
                ->withErrors($validator)
                ->withInput(Input::all());
        }

        //validate artwork requirements (before creating a submission to avoid creating an empty
        //submission)
        if($exhibit->type == 'ANNUAL_STUDENT_SHOW'){
            $attributes = request()->validate(ArtworkFormRequest::rules_annual_student_show());
        }
        else {
            $attributes = request()->validate(ArtworkFormRequest::rules_many());
        }

       //create a submission object
        $submission = new Submission();
        // set Submission object foreign keys
        $submission->user_id = $request->user()->id;
        $submission->exhibit_id = $exhibit_id;
        // set Submission attributes from user input
        $submission->comments = Input::get('comments');
        $submission->status = false;
        $submission->admin_comments = "";
        $submission->notified = false;
        $submission->save();

        // if the submission is for an experimental exhibit, create an experimental
        //submission and store the fields
        if($exhibit->type == "EXPERIMENTAL_SPACE_PLAN"){
            $experimental = new ExperimentalSubmission();
            //get whether the user is applying as an individual student or RSO
            $experimental->rso = Input::get('rso');
            //store the rso name
            if(Input::has('rso_name')) {
                $experimental->rso_name = Input::get('rso_name');
            }
            //store the numparticipants
            if(Input::has('rso_num_participants')){
                $experimental->rso_num_participants = Input::get('rso_num_participants');
            }
            //store the faculty adviser
            if(Input::has('faculty_adviser')){
                $experimental->faculty_adviser = Input::get('faculty_adviser');
            }
            $experimental->walls = Input::get('walls');
            $experimental->pedestals = Input::get('pedestals');
            //store whether or not a brick wall is okay
            if(Input::get('brick_ok') == 'yes'){
                $experimental->brick_ok = true;
            }
            //store additional resources
            if(Input::has('additional_resources')){
                $experimental->additional_resources = Input::get('additional_resources');
            }
            //save the experimental_space fields
            $experimental->save();
            // link experimental space table entry to submission table entry
            $experimental->submission()->save($submission);
        }
        //after the submission has been saved, use its id as a foreign key when
        //the artworks are stored
        app('App\Http\Controllers\ArtworkController')->store_many($request, $submission->id);
        return redirect(route('dashboard'));
    }


    //function to toggle the "notified" status of a submission
    public function notify( Submission $submission){
        $exhibit = $submission->exhibit;

        if($submission->notified) {
            $submission->notified = false;
        }
        else{
            $submission->notified = true;
        }

        $submission->update();
          //return to the submission management page
        $submissions = $exhibit->submissions()->paginate(15);
        return redirect(route('submission.index', $exhibit));
    }

    //notify all applicants to an exhibit
    public function all_notify(Exhibit $exhibit){
        $submissions = $exhibit->submissions()->get();

        //for each submission, set notified equal to true and save.
        foreach($submissions as $submission){

            $submission->notified = true;
            $submission->update();
        }

        //return to the submission management page
        $submissions = $exhibit->submissions()->paginate(15);
        return redirect(route('submission.index', $exhibit));

    }

    //delete a submission
    public function destroy(Submission $submission){
        $exhibit_id = $submission->exhibit_id;
        $submission->delete();
        return redirect('submission/admin/' . $exhibit_id);
    }
}
