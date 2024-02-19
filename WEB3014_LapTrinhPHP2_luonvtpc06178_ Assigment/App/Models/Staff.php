<?php

namespace App\Models;

class Staff extends BaseModel
{
    // protected $name = 'employe';
    public $tableName = 'employees';
    public $table = "employees";

    public function getAllStaff()
    {
        return $this->getAll();
    }
    public function getOneStaff($id)
    {
        return $this->getOne($id);
    }
    public function updateDataStaff($id, $data)
    {
        return $this->update($id, $data);
    }
    public function countAllStaff()
    {
        return $this->countAll();
    }
    public function getAllWithPaginateDemo($limit, $page)
    {
        return $this->getAllWithPaginate($limit, $page);
    }
    public function create($data)
    {
        var_dump($this->tableName);
    }
    public function insertDataStaff($table, $data)
    {
        return $this->insertData($table, $data);
    }
    public function deleteDataStaff($table, $condition)
    {
        return $this->deleteData($table, $condition = 'id');
    }
    public function deleteStaff($id)
    {
        return $this->delete($id);
    }
    
}
