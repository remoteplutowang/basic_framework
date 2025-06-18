<?php
namespace App\Utils;


class Tree
{
    const CONST_TYPE_CATEGORY = 1;
    const CONST_TYPE_ITEM = 2;

    /**
     * @param array $elements item中必须有 id，parent_id,item_type三个字段
     * @param int $parentId
     * @return array
     */
    public static function buildTree(array $elements, $parentId = 0) {
        $tree = [];
        foreach ($elements as &$item) {
            if ($item["parent_id"] == $parentId) {
                $children = Tree::buildTree($elements, $item["id"]);
                if($children) {
                    $item["children"] = $children;
                }
                if($item["item_type"] == self::CONST_TYPE_CATEGORY){
                    $tree[$item["item"]] = $item;
                } else {
                    $tree[$item["id"]] = $item;
                }
            }
        }
        return $tree;
    }


    public static function findItem($tree, $keyArray) {
        $retValue = [];
        foreach ($tree as $element) {
            $key = "";
            if(in_array($element['item'],$keyArray)){
                $key = $element['item'];
            }
            if(in_array($element['id'],$keyArray)){
                $key = $element['id'];
            }
            if(!empty($key)){
                $retValue[$key] = $element;
                $keyArray = array_diff($keyArray, [$key]);
            }
            if(empty($keyArray)){
                return $retValue;
            }
            if (!empty($element['children'])) {
                $result = Tree::findItem($element['children'], $keyArray);
                if ($result) {
                    foreach($result as $key => $value){
                        $retValue[$key] = $value;
                    }
                    return $retValue;
                }
            }
        }
        return $retValue;
    }

}
