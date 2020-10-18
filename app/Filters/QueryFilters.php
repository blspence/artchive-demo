<?php

namespace App\Filters;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

abstract class QueryFilters {
    protected $request;
    protected $builder;

    public function __construct(Request $request){
        $this->request = $request;
    }

    /**
     * Apply the appropriate filters to the builder
     *
     * @param Builder $builder
     * @return Builder
     */
    public function apply(Builder $builder) {
        $this->builder = $builder;
        foreach ($this->filters() as $name => $value) {
            if (! method_exists($this, $name)) {
                continue;
            }
            if (strlen($value)>0) {
                $this->$name($value);
            }
        }

        return $this->builder;
    }

    /**
     * get all request filters data
     *
     * @return array
     */
    public function filters() {
        return $this->request->all();
    }
}
