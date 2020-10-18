<?php

namespace App\Filters;

use App\Artwork;
use Illuminate\Support\Facades\DB;
use App\Filters\QueryFilters;

class ArtworkFilters extends QueryFilters {

    /**
     * Filter by title substring
     *
     * @param string $title the searched-for title
     * @return builder
     */
    public function title($title) { // artwork/title=art
        return $this->builder->where('title', 'LIKE', '%' . $title .'%');
    }

    /**
     * Filter by medium substring
     *
     * @param string $medium the searched-for medium
     * @return builder
     */
    public function medium($medium) {
        return $this->builder->where('medium', 'LIKE', '%' . $medium .'%');
    }

    //filter by artist name
    public function artist($artist){

        //get the array of user ids whose names have the artist's name search term as a substring
        $users = DB::table('users')
            ->where('first_name', 'LIKE', '%' . $artist . '%')
            ->orWhere('last_name', 'LIKE', '%' . $artist . '%')
            ->pluck('id')
            ->toArray();

        //find the artworks that belong to the matching users.
        return $this->builder->whereIn('user_id', $users);

    }
}
