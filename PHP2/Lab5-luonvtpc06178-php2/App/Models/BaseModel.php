<?php
    namespace App\Models;

    use App\Interfaces\ModelInterface;

    abstract class BaseModel implements ModelInterface{
        protected $table;
        function __construct($table) {
            $this -> table = $table;
            echo $table.'<br>';
        }

        public function create(array $data)
        {
            echo "function Create";
        }

        public function getOne($id, $condition)
        {
            echo "function getOne";
        }

        public function getAll()
        {
            echo "function getAll";
        }
        
        public function update($id, array $data)
        {
            echo "function Update";
        }

        public function delete($id)
        {
            echo "function Delete";
        }
    }
?>