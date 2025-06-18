<?php


namespace App\Filter\Admin;

use App\Filter\Filter;

class AdminNameFilter extends Filter
{
    public function doFilter()
    {
        // TODO: Implement doFilter() method.
        return $this->mQuery->where("admin_name","like",'%'.$this->mParam."%");
    }
}
