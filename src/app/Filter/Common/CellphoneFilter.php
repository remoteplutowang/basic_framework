<?php


namespace App\Filter\Common;

use App\Filter\Filter;

class CellphoneFilter extends Filter
{
    public function doFilter()
    {
        // TODO: Implement doFilter() method.
        return $this->mQuery->where("cellphone",$this->mParam);
    }
}
