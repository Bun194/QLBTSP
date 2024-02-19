<?php

namespace App\Models;

class Product extends BaseModel
{
    // protected $name = 'employe';
    public $tableName = 'products';
    public $table = "products";


    public function getAllProduct()
    {
        return $this->getAll();
    }
    public function getOneProduct($id)
    {
        return $this->getOne($id);
    }
    public function updateDataProduct($id, $data)
    {
        return $this->update($id, $data);
    }
    public function countAllProducts()
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
    public function insertDataProduct($table, $data)
    {
        return $this->insertData($table, $data);
    }
    public function deleteDataProduct($table, $condition)
    {
        return $this->deleteData($table, $condition = 'id');
    }
    public function deleteProduct($id)
    {
        return $this->delete($id);
    }
    
}
