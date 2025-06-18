<?php
namespace App\Contracts;

interface IRepository
{
    public function create(array $data);
    public function update($primaryKey, array $data);
    public function delete($primaryKey);
    public function info($primaryKey);

    //处理批量数据
    public function insert(array $data);
    public function upsert(array $data,array $uniqueKeys);
    public function deleteByCond(array $conditions);
    public function findByCond(array $conditions,$sort= array());
    public function updateByCond(array $conditions,array $updateData);
    public function batchUpsert(array $data,array $updateColumns);
    public function search($params,$sort= array(),$columns = array('*'),$page = 0,$page_size = 0);
    public function decrement(array $conditions,$field,$decrAmount);
}
