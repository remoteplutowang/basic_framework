<?php


namespace App\Filter\Common;

use App\Filter\Filter;

class IdFilter extends Filter
{
    public function doFilter()
    {
        // TODO: Implement doFilter() method.
        $params = $this->param2Array($this->mParam);
        return $this->mQuery->whereIn("id",$params);
    }
}
