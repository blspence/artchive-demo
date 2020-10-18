<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;
use App\Artwork;
use Illuminate\Http\Request;
use App\Utilities\ImageUtilities;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileFormRequest;
use Illuminate\Support\Facades\Input;

/**
 * This controller class handles requests for the Profile model
 * and associated views.
 */
class ProfileController extends Controller
{
    /**
     * Displays a listing of all profiles in the database.
     *
     * @return Response
     */
    public function index()
    {
        $profiles = Profile::paginate(10);
        return view('profiles.index', compact('profiles'));
    }

    /**
     * Stores a newly created profile in the database;
     * this function is only called from the UserController's
     * store() function with the pre-validated & pre-populated array
     * (and is thus not associated with a route in web.php).
     *
     * @todo determine better default profile photo?
     *
     * @param array $profile_input
     * @return int $profile->id
     */
    public static function store(array $profile_input)
    {
        // create new Profile object
        $profile = new Profile();

        ProfileController::update_profile_photo($profile_input, $profile);

        // $profile->biography = Input::get('biography');
        $profile->major = Input::get('major');
        $profile->rso = Input::get('rso');
        $profile->instagram_url = Input::get('instagram_url');
        $profile->linkedin_url = Input::get('linkedin_url');
        $profile->facebook_url = Input::get('facebook_url');

        $profile->save();

        return $profile->id;
    }

    /**
     * Displays a view to show the given user's public profile.
     *
     * @param Profile $profile
     * @return Response
     */
    public function show(Profile $profile)
    {
        $user = User::where('profile_id', $profile->id)->first();

        //get all artworks for the user's profile that have a public photo
        //sort by newest first.
        $artworks = Artwork::where('user_id', $user->id)
            ->where('public_photo_url', '<>',  "")
            ->orderBy('created_at', 'desc')
            ->paginate(8);

        return view('profiles.show', compact('profile', 'user', 'artworks'));
    }

    /**
     * Shows the form for editing the given profile.
     *
     * @param Profile $profile
     * @return Response
     */
    public function edit(Profile $profile)
    {
        return view('profiles.edit', compact('profile'));
    }

    /**
     * Updates the given profile in the database.
     *
     * @param Request $request
     * @param Profile $profile
     * @return Response
     */
    public function update(Request $request, Profile $profile)
    {
        // init input arrays from $request
        $input = ProfileController::init_input(Input::all());

        // make validator
        $validator = ProfileController::validator($input);

        if ($validator->fails())
        {
            $errors = $validator->messages();

            if ($errors->has('profile_photo_url'))
            {
                // ignore errors for profile_photo_url,
                // since we're taking it in from the user
            }
            else
            {
                return Redirect::to(route('profile.edit', $profile))
                    ->withErrors($errors)
                    ->withInput($input);
            }
        }

        ProfileController::update_profile_photo(Input::all(), $profile);

        $profile->biography = Input::get('biography');
        $profile->major = Input::get('major');
        $profile->rso = Input::get('rso');
        $profile->instagram_url = Input::get('instagram_url');
        $profile->linkedin_url = Input::get('linkedin_url');
        $profile->facebook_url = Input::get('facebook_url');

        // save Profile to the database
        $profile->save();

        return redirect(route('profile.show', $profile));
    }

    /**
     * Deletes the given profile from the database.
     *
     * @todo mark user as inactive vs cascade foreign keys
     *
     * @param Profile $profile
     * @return Response
     */
    public function destroy(Profile $profile)
    {
        $profile->delete();

        return redirect(route('profiles.index'));
    }

    /**
     * Updates the profile_photo_url attribute of the Profile
     * with the given array of $request data.
     *
     * @param array $request
     * @param Profile $profile
     */
    public static function update_profile_photo(array $request, Profile &$profile)
    {
        // handle profile photo
        if(Input::file('profile_photo') != null)
        {
            $profile->profile_photo_url = ImageUtilities::store_image(
                                              Input::file('profile_photo'));
        }
        else if ($profile->profile_photo_url == null)
        {
            // set default photo
            $profile->profile_photo_url = Storage::url('images/default_profile_photo.png');
        }
    }

    /**
     * Initializes the input array for the User object.
     *
     * @param  array $request
     * @return array
     */
    public static function init_input(array $request)
    {
        $input = [
            'biography' => Input::get('biography'),
            'profile_photo_url' => Input::get('profile_photo_url'),
            'profile_photo' => Input::file('profile_photo'),
            'major' => Input::get('major'),
            'rso' => Input::get('rso'),
            'instagram_url' => Input::get('instagram_url'),
            'linkedin_url' => Input::get('linkedin_url'),
            'facebook_url' => Input::get('facebook_url')
        ];

        return $input;
    }

    /**
     * Get a validator for the incoming request for the Profile model.
     *
     * @param  array $data
     * @return Validator
     */
    public static function validator(array $data)
    {
        return Validator::make($data, ProfileFormRequest::rules());
    }

}
