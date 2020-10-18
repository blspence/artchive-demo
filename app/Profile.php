<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';

    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'biography',
        'profile_photo_url',
        'major',
        'rso',
        'instagram_url',
        'linkedin_url',
        'facebook_url'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
