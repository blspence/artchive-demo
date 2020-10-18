<?php

namespace App\Http\Controllers;

use App\User;
use App\Artwork;
use App\Submission;
use App\Utilities\Role;
use App\Utilities\ImageUtilities;
use App\Http\Requests\UserFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Auth\RegisterController;
use App\Filters\UserFilters;

/**
 * This controller class handles requests for the User model and associated views.
 */
class UserController extends Controller
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
     * Displays a listing of all users in the database.
     *
     * @return Response
     */
    public function index(UserFilters $filters)
    {
        $users = User::filter($filters)->paginate(10);

        return view('users.index',      // resources/views/users/index.blade.php
                    compact('users'));  // send array of users
    }

    /**
     * Stores a newly created user in the database;
     * this function is only called from the RegisterController's
     * create() function with the pre-validated & pre-populated arrays
     * (and is thus not associated with a route in web.php).
     *
     * @param array $user_input
     * @param array $profile_input
     * @return User $user
     */
    public static function store(array $user_input, array $profile_input)
    {
        // create and update User object
        $user = new User();
        $user->first_name = $user_input['first_name'];
        $user->last_name = $user_input['last_name'];
        $user->username = $user_input['username'];
        $user->phone_number = $user_input['phone_number'];
        $user->password = Hash::make($user_input['password']);

        // Create Profile and establish foreign key relationship with User
        $user->profile_id = ProfileController::store($profile_input);

        // save User to the database
        $user->save();

        // update User Role
        $user->setRole("USER");

        return $user;
    }

    /**
     * Displays a view to show the given user's private information.
     *
     * @param User $user
     * @return Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Shows the form for editing the given user.
     *
     * @param User $user
     * @return Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Updates the given user in the database.
     *
     * @todo validate admin demoting themselves if there is only one admin
     *       for the user role
     *
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function update(Request $request, User $user)
    {
        // init input arrays from $request
        $input = UserController::init_input(Input::all());

        // make validator
        $validator = UserController::validator($input);

        if ($validator->fails())
        {
            $errors = $validator->messages();

            if (($errors->has('username') ||
                 $errors->has('password') ||
                 $errors->has('role')))
            {
                // ignore errors for username & password,
                // since we're not updating those;
                // role is a dropdown and doesn't need validation
            }
            else
            {
                return Redirect::to(route('user.edit', $user))
                    ->withErrors($errors)
                    ->withInput($input);
            }
        }

        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];
        $user->phone_number = $input['phone_number'];

        // save User to the database
        $user->save();

        // update user role if provided
        if($input['role'] != null)
        {
            $user->setRole($input['role']);
        }

        return redirect(route('user.show', $user));
    }

    /**
     * Deletes the given user from the database.
     *
     * @todo prompt user before deletion; cascade foreign keys
     *
     * @param User $user
     * @return Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect('/user');
    }

    /**
     * Display view to show a specified resource.
     *
     * @param User $user
     */
    public function dashboard(Request $request)
    {
        $submissions = Submission::where('user_id', $request->user()->id)
            ->orderBy('exhibit_id', 'desc') // TODO fix later
            ->paginate(10);

        return view('dashboard', compact('submissions'));
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
            'first_name'   => Input::get('first_name'),
            'last_name'    => Input::get('last_name'),
            'username'     => Input::get('username'),
            'phone_number' => Input::get('phone_number'),
            'password'     => Input::get('password'),
            'role'         => Input::get('role')
        ];

        return $input;
    }

    /**
     * Get a validator for the incoming request for the User model.
     *
     * @param  array $data
     * @return Validator
     */
    public static function validator(array $data)
    {
        return Validator::make($data, UserFormRequest::rules());
    }

    // takes user id & returns true if user exists with given attribute
    // TODO
    public function exists(string $attr_name, string $attr_val)
    {
        return DB::table('users')->where($attr_name, $attr_val)->exists();
    }
}
