<?php

namespace App\Models;

class Maintenance extends BaseModel
{
    public $tableName = 'maintenance';
    public $table = "maintenance";
    public function SearchHome($table, $keyword)
    {
        return $this->search($table, $keyword);
    }
    public function getAllMaintenance()
    {
        return $this->getAll();
    }
    public function getOneMaintenance($id)
    {
        return $this->getOne($id);
    }
    public function updateDataMaintenance($id, $data)
    {
        return $this->update($id, $data);
    }
    public function countAllMaintenance()
    {
        return $this->countAll();
    }
    public function totalCostAll()
    {
        return $this->totalCost();
    }
    public function getAllWithPaginateDemo($limit, $page)
    {
        return $this->getAllWithPaginate($limit, $page);
    }
    public function create($data)
    {
        var_dump($this->tableName);
    }
    public function insertDataMaintenance($table, $data)
    {
        return $this->insertData($table, $data);
    }
    public function deleteDataMaintenance($table, $condition)
    {
        return $this->deleteData($table, $condition = 'id');
    }
    public function deleteMaintenance($id)
    {
        return $this->delete($id);
    }
    
}
