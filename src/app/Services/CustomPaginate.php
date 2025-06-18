<?php


namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;

class CustomPaginate extends LengthAwarePaginator
{
    protected array $mCustomAttribute = [];

    public function AddField($fieldName,$value)
    {
        $this->mCustomAttribute[$fieldName] = $value;
    }

    public function toArray()
    {
        $retValue = [
            'page' => $this->currentPage(),
            'page_size' => (int)$this->perPage(),
            'total' => $this->total(),
            'list' => $this->items->toArray()
        ];
        foreach($this->mCustomAttribute as $fieldName => $value){
            $retValue[$fieldName] = $value;
        }
        return $retValue;
    }
}
