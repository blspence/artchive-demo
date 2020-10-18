<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Filters\Filterable;

class Submission extends Model
{
  protected $table = 'submissions';
  use Filterable;

   public function user() {
     return $this->belongsTo('App\User');
   }

   public function artwork() {
     return $this->hasMany('App\Artwork');
   }

   public function exhibit(){
     return $this->belongsTo('App\Exhibit');
   }

   public function submitable(){
       return $this -> morphTo();
   }


    /**
    * Override parent boot to delete submitable object when the submission is deleted
    */
    public static function boot(){
        parent::boot();

        static::deleting(function($submission){
            //if the submission has a submitable table entry, delete it.

            if($submission->submitable != null){
                $submission->submitable()->delete();
            }

        });
    }

}
