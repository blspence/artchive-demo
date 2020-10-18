<?php

namespace App\Filters;

use App\Exhibit;
use Illuminate\Support\Facades\DB;
use App\Filters\QueryFilters;

class UserFilters extends QueryFilters {

    // /**
    //  * Filter by artist's name substring
    //  *
    //  * @param string $title the searched-for title
    //  * @return builder
    //  */

    /**
     * Filter by artist's firstname substring
     *
     * @param string $title the searched-for title
     * @return builder
     */
    public function first_name($firstname) {
        return $this->builder->where('first_name', 'LIKE', '%' . $firstname .'%');
    }


    /**
     * Filter by artist's firstname substring
     *
     * @param string $title the searched-for title
     * @return builder
     */
    public function last_name($lastname) {
        return $this->builder->where('last_name', 'LIKE', '%' . $lastname .'%');
    }

    /**
     * Filter by artist role
     *
     * @param string $role the searched-for role
     * @return builder
     */

    public function role($role){

        //get the array of user ids whose names have the artist's name search term as a substring
        return $this->builder->where('role', '=', $role);
    }

    /**
     * Filter by username substring
     *
     * @param string $username the searched for username
     * @return builder
     */
     public function username($username)
     {
         return $this->builder->where('username', 'LIKE', '%' . $username . '%');
     }

}
