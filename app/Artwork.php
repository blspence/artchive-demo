<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Filters\Filterable;

class Artwork extends Model
{
    use Filterable;

    public $timestamps = false;
    protected $table = 'artworks';
    protected $guarded = ['id'];


    public function user(){
      return $this -> belongsTo('App\User');
    }

    public function submission(){
      return $this -> belongsTo('App\Submission');
    }

}
