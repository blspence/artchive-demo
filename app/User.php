<?php

namespace App;

use App\Utilities\Role;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Filters\Filterable;

class User extends Authenticatable
{
    protected $table = 'users';
    use Filterable;

    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'phone_number',
        'password'
    ];

    /**
     * Attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'role'
    ];

    /**
     * Attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Links the User class to the Profile class as a foreign key reference.
     */
    public function profile()
    {
        return $this->hasOne('App\Profile');
    }

    /**
     * Links the User class to the Artwork class as a foreign key reference.
     */
    public function artwork()
    {
        return $this->hasMany('App\Artwork');
    }

    /**
     * Links the User class to the Submission class as a foreign key reference.
     */
    public function submissions()
    {
        return $this->hasMany('App\Submission');
    }

    /**
     * Gets the user $role as an enum.
     *
     * @return Role $role
     */
    private function getRoleEnum()
    {
        $key = $this->attributes['role'];

        if (Role::isValidKey($key))
        {
            return Role::getRoleByKey($key);
        }
        else
        {
            return Role::GUEST;
        }
    }

    /**
     * Sets the given user $role with the provided $key.
     *
     * @param string $key
     */
    public function setRole(string $key)
    {
        if (Role::isValidKey($key))
        {
            $this->attributes['role'] = $key;
        }
        else
        {
            // default to GUEST role
            $this->attributes['role'] = (Role::GUEST).getKey();
        }

        // save changes to the database
        $this->save();
    }

    /**
     * Gets the user role as a string.
     *
     * @return string
     */
    public function getRole()
    {
        return $this->getRoleEnum()->getKey();
    }

    /**
     * Gets the user role as a string.
     *
     * @return string
     */
    public function getAllRoles()
    {
        return Role::getRolesAsStr();
    }

    /**
     * Returns true if the user is authorized to perform
     * an action based on their user role, given the
     * $min_role needed as a string.
     *
     * @param $min_role
     * @return bool
     */
    public function isAuthorized(string $min_role)
    {
        if (Role::isValidKey($min_role))
        {
            $user_role = $this->getRoleEnum();
            $min_role_obj = Role::getRoleByKey($min_role);

            return $user_role->isAuthorized($min_role_obj);
        }
        else
        {
            // key is invalid; default case
            return false;
        }
    }

}
