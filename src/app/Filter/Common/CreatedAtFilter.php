<?php


namespace App\Filter\Common;

use App\Filter\Filter;

class CreatedAtFilter extends Filter
{
    public function doFilter()
    {
        // TODO: Implement doFilter() method.
        $operate = $this->mParam[0];
        $value = $this->mParam[1];
        return $this->mQuery->where("created_at",$operate,$value);
    }
}
