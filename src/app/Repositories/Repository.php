<?php
namespace App\Repositories;

use App\Contracts\IRepository;
use App\Filter\FilterPolicy;
use Illuminate\Support\Facades\DB;

abstract class Repository implements IRepository
{
    protected string $mModel ;

    protected string $mFilterNameSpace;

    public function create(array $data)
    {
        return $this->mModel::create($data);
    }

    public function update($primaryKey, array $data)
    {
        // TODO: Implement update() method.
        $entity = $this->mModel::findOrFail($primaryKey);
        $entity->update($data);
        return $entity;
    }

    public function delete($primaryKey)
    {
        // TODO: Implement delete() method.
        return $this->mModel::destroy($primaryKey);
    }

    public function info($primaryKey)
    {
        // TODO: Implement find() method.
        return $this->mModel::findOrFail($primaryKey);
    }

    public function search($params, $sort = array(),$columns = array('*'), $page = 0, $page_size = 0)
    {
        // TODO: Implement search() method.
        $filterPolicy = new FilterPolicy();
        $query = $this->mModel::query();
        $query = $filterPolicy->apply($query, $this->mFilterNameSpace,$params);
        if (!empty($sort)) {
            foreach ($sort as $sortBy => $order) {
                $query->orderby($sortBy, $order);
            }
        }
        return $page > 0 ? $query->paginate($page_size, $columns) : $query->get($columns);
    }

    public function insert(array $data)
    {
        return $this->mModel::insert($data);
    }

    public function upsert(array $data,array $condition){
        return $this->mModel::updateOrCreate($condition, $data);
    }

    public function deleteByCond(array $conditions)
    {
        $retValue = false;
        $filterPolicy = new FilterPolicy();
        $query = $this->mModel::query();
        $conditionQuery = $filterPolicy->apply($query, $this->mFilterNameSpace,$conditions);
        $bindings = $conditionQuery->getBindings();
        //是否应用了条件查询,未应用不进行删除
        if(!empty($bindings)){
            $retValue = $conditionQuery->delete();
        }
        return $retValue;
    }

    public function findByCond(array $conditions,$sort= array())
    {
        $retValue = null;
        $filterPolicy = new FilterPolicy();
        $query = $this->mModel::query();
        $conditionQuery = $filterPolicy->apply($query, $this->mFilterNameSpace,$conditions);
        if (!empty($sort)) {
            foreach ($sort as $sortBy => $order) {
                $conditionQuery->orderby($sortBy, $order);
            }
        }
        $bindings = $conditionQuery->getBindings();
        if(!empty($bindings)){
            $retValue = $conditionQuery->first();
        }
        return $retValue;
    }

    public function updateByCond(array $conditions,array $updateData)
    {
        $retValue = null;
        $filterPolicy = new FilterPolicy();
        $query = $this->mModel::query();
        $conditionQuery = $filterPolicy->apply($query, $this->mFilterNameSpace,$conditions);
        $bindings = $conditionQuery->getBindings();
        //是否应用了条件查询,未应用不进行更新
        if(!empty($bindings)){
            $retValue = $conditionQuery->update($updateData);
        }
        return $retValue;
    }

    public function batchUpsert(array $data,array $updateColumns)
    {
        // Start a transaction
        DB::beginTransaction();
        try {
            $table = (new $this->mModel())->getTable();
            // Generate the raw SQL query for batch insert with ON DUPLICATE KEY UPDATE
            $bindings = [];
            $placeholders = [];
            $columns = array_keys($data[0]);
            foreach ($data as $row) {
                $placeholders[] = "(".rtrim(str_repeat('?,',count($row)),',').")";
                $bindings = array_merge($bindings,array_values($row));
            }
            $sql = "INSERT INTO {$table} (".implode(",",$columns).") VALUES " . implode(",", $placeholders) . " ON DUPLICATE KEY UPDATE ";
            $updates = [];
            foreach ($updateColumns as $column) {
                $updates[] = "`{$column}` = values({$column})";
            }
            $sql .= implode(",",$updates);
            // Execute the raw SQL query within the transaction
            DB::statement($sql, $bindings);

            // Commit the transaction
            DB::commit();
            $retValue = true;
        } catch (\Exception $e) {
            // Rollback the transaction if an exception occurs
            DB::rollBack();
            // Handle the exception
            $retValue = false;
        }
        return $retValue;
    }

    public function decrement($params, $field,$decrAmount)
    {
        // TODO: Implement decrement() method.
        $filterPolicy = new FilterPolicy();
        $query = $this->mModel::query();
        $query = $filterPolicy->apply($query, $this->mFilterNameSpace,$params);
        return $query->decrement($field,$decrAmount);
    }
}
