<?php
namespace App\Contracts;

interface IFilter
{
    public function setParam($param);
    public function doFilter();
}


