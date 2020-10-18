<?php

namespace App;

use Illuminate\Database\Eloquent;

class ExperimentalSubmission extends Submission
{

    protected $table = 'experimental_submissions';

    public function submission(){

        return $this->morphOne('App\Submission', 'submitable');
    }
}
