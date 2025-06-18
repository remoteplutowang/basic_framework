<?php


namespace App\Filter\Admin;

use App\Filter\Filter;

class AdminAccountFilter extends Filter
{
    public function doFilter()
    {
        // TODO: Implement doFilter() method.
        return $this->mQuery->where("admin_account",$this->mParam);
    }
}
