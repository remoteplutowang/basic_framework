<?php

namespace App\Filter;

use App\Contracts\IFilter;
//use \Illuminate\Database\Eloquent\Builder;

abstract class Filter implements IFilter
{
    //protected Builder $mQuery;
    protected $mQuery;
    protected $mParam;

    //public function __construct(Builder $query)
    public function __construct($query)
    {
        $this->mQuery = $query;
    }

    public function setParam($param)
    {
        if(!empty($param)){
            $this->mParam = $param;
        }
    }


    protected function param2Array($value) : array
    {
        $params = [];
        if (!is_array($value)) {
            $params[] = $value;
        } else {
            $params = $value;
        }
        return $params;
    }

}

