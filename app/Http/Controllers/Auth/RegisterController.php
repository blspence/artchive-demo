<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\UserFormRequest; // TODO - remove

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    private $user_input;
    private $profile_input;

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user_input = [];
        $this->profile_input = [];
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     * @todo - delete this - it's unused...
     *
     * @param  array $data
     * @return Validator
     */
    public function validator(array $data)
    {
        return Validator::make($data, UserFormRequest::rules());
    }

    /**
     * Validates an incoming request and initializes the input arrays for the
     * user and profile objects.
     *
     * @param  array $user_input
     * @param  array $profile_input
     * @return boolean
     */
    public function validate_registration(array $request)
    {
        // init input arrays from $request
        $this->user_input = UserController::init_input($request);
        $this->profile_input = ProfileController::init_input($request);

        // make user and profile validators
        $user_validator = UserController::validator($this->user_input);
        $profile_validator = ProfileController::validator($this->profile_input);

        if ($user_validator->fails() || $profile_validator->fails() )
        {
            $errors = $user_validator->messages()->merge($profile_validator->messages());

            return Redirect::to(url('/register'))
                ->withErrors($errors)
                ->withInput($request);
        }
    }

    /**
     * Create a new user instance with assoicated profile after a valid registration.
     *
     * @param array $request
     * @return User $user
     */
    protected function create(array $request)
    {
        $this->validate_registration($request);

        // create User and associated Profile objects
        // note: UserController calls the ProfileController's store() method
        //       to create the profile object
        $user = UserController::store($this->user_input, $this->profile_input);

        return $user;
    }
}
