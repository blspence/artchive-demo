<?php

namespace App\Filters;

use App\Exhibit;
use Illuminate\Support\Facades\DB;
use App\Filters\QueryFilters;

class ExhibitFilters extends QueryFilters {

    /**
     * Filter by title substring
     *
     * @param string $title the searched-for title
     * @return builder
     */
    public function title($title) {
        return $this->builder->where('title', 'LIKE', '%' . $title .'%');
    }


        /**
     * Filter by title substring
     *
     * @param string $the selected type of exhibit
     * @return builder
     */
    public function type($type) {
        return $this->builder->where('type', '=', $type);
    }


}
