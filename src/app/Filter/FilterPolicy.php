<?php
namespace App\Filter;
use \App\Utils\Utility;

class FilterPolicy
{
    public function apply($query, $namespace,$params)
    {
        foreach($params as $field => $value){
            if(!empty($value)){
                $class = Utility::underScore2Camel($field)."Filter";
                $filter = $namespace.$class;
                $commonFilter = "App\Filter\Common\\".$class;
                $filterEntity = null;
                if(class_exists($filter)){
                    $filterEntity= new $filter($query);
                }else if(class_exists($commonFilter)){
                    $filterEntity = new $commonFilter($query);
                }
                if(!empty($filterEntity)){
                    $filterEntity->setParam($value);
                    $query = $filterEntity->doFilter();
                }
            }
        }
        return $query;
    }
}
