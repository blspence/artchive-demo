<?php

namespace App\Filters;

use App\Exhibit;
use Illuminate\Support\Facades\DB;
use App\Filters\QueryFilters;

class SubmissionFilters extends QueryFilters {
     /**
     * Filter by artist's firstname substring
     *
     * @param string $title the searched-for title
     * @return builder
     */
    public function artist($artist) {
    //get the array of user ids whose names have the artist's name search term as a substring
        $users = DB::table('users')
            ->where('first_name', 'LIKE', '%' . $artist . '%')
            ->orWhere('last_name', 'LIKE', '%' . $artist . '%')
            ->pluck('id')
            ->toArray();

        //find the submissions that belong to the matching users.
        return $this->builder->whereIn('user_id', $users);
    }


    /**
     * Filter by submission status (ie, whether the artist's submission has
     * been accepted or rejected)
     * 
     * @param string $status : 0 if searching for rejected, 1 if searching for accepted
     */

     public function status($status){
        return $this->builder->where('status', '=', $status);
     }

    // search by submission status (whether or not the student has been notified)


}
