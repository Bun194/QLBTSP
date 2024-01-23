<?php
    namespace App\Interfaces;

    interface ModelInterface {
        // Chứa các phương thức bắt buộc các hàm chuyển khai đều phải gọi (CRUD)

        public function create(array $data);

        public function getOne($id, $condition);

        public function getAll();

        public function update($id,array $data);

        public function delete($id);
    }
?>