<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Filters\Filterable;

class Exhibit extends Model
{

    use Filterable;

    protected $table = 'exhibits';

    protected $guarded = ['id'];

    //return all artworks associated with a particular exhibit
    public function artworks(){
        return $this->hasManyThrough('App\Artwork', 'App\Submission');
    }

    //return all artworks that were accepted to a particular exhibit
    public function accepted_artworks(){
       //get the accepted submissions
       $artworks = $this->submissions()
            ->where('status', '=', true)
            ->join('artworks', 'submissions.id', '=', 'artworks.submission_id')
            ->select('artworks.*');
        return $artworks;
    }

    //return all users associated with a particular exhibit
    public function users(){
        return $this->hasManyThrough(
            'App\User',
            'App\Submission',
            'exhibit_id',
            'id',
            'id');
    }

    //return all users with artwork that was accepted to a given exhibit
    public function accepted_users_names(){
        $submissions = $this->submissions();
        $users = $submissions->where('status', '=', true)->pluck('user_id')->toArray();

        return User::select('id', 'first_name', 'last_name')
            ->whereIn('id', $users)
            ->get();
        // return User::findMany($users)->get('id', 'first_name', 'last_name');
    }

    //return all submissions associated with a particular exhibit
    public function submissions(){
      return $this->hasMany('App\Submission');
    }


    /**
    * Override parent boot to delete submitable object when the submissions
    * for the exhibit are deleted
    */
    public static function boot(){
        parent::boot();

        static::deleting(function($exhibit){
            //for each submission in the exhibit, if it has a submitable table entry,
            //delete it.
            foreach($exhibit->submissions()->get() as $submission) {
                if($submission->submitable != null){
                    $submission->submitable()->delete();
                }
            }
        });
    }
}
