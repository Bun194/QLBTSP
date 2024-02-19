<?php
namespace App\Models;
class User extends BaseModel{
    // protected $name = 'employe';
    public $tableName = 'employees';
    public $table = "employees";
    
    public function getAllUser(){
        return $this->getAll();
    }
    public function getOneUser($EmployeeID){
        return $this->getOne($EmployeeID);
    }
    public function registerUser($data){
        $user = $this->insert($this->table, $data);
    }
    public function checkUserExist($Email)
    {
        return $this->select()->where('Email', '=', $Email)->first();
    }
    public function getAllWithPaginate(int $limit = 10, int $offset = 0)
    {
        // return $this->select()->where('email', '=', $email)->first();
    }
    public function create($data)
    {
        var_dump($this->tableName);
    }
}