<?php


namespace App\Filter\User;

use App\Filter\Filter;

class UserNameFilter extends Filter
{
    public function doFilter()
    {
        // TODO: Implement doFilter() method.
        return $this->mQuery->where("name","like",'%'.$this->mParam."%");
    }
}
