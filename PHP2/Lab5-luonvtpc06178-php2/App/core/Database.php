<?php
namespace App\core;
use PDO;
use PDOException;
class Database
{
    public function pdo_get_connection(){
        try {
            $conn = new PDO('mysql:host=localhost;dbname=qlbaotri','root','123');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo "Kết nối đến cơ sở dữ liệu không thành công: " . $e->getMessage();
            exit;
        }
    }
    function pdo_execute($sql)
    {
        $sql_args = array_slice(func_get_args(), 1);
        try {
            //code...
            $conn = $this->pdo_get_connection(); //kết nối csdl
            $stmt = $conn->prepare($sql);
            $stmt->execute($sql_args); //thực thi và truyền dữ liệ của biến vào 
            return $stmt;
        } catch (PDOException $e) {
            //throw $th;
            throw $e;
        } finally {
            unset($conn);
        }
    }
    //lấy nhiều dòng
    function pdo_query($sql)
    {
        $sql_args = array_slice(func_get_args(), 1);
        try {
            $conn = $this->pdo_get_connection();
            $stmt = $conn->prepare($sql);
            $stmt->execute($sql_args);
            $rows = $stmt->fetchAll();
            return $rows;
        } catch (PDOException $e) {
            throw $e;
        } finally {
            unset($conn);
        }
    }
    //trả 1 kết quả
    function pdo_query_one($sql)
    {
        $sql_args = array_slice(func_get_args(), 1);
        try {
            $conn = $this->pdo_get_connection();
            $stmt = $conn->prepare($sql);
            $stmt->execute($sql_args);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        } catch (PDOException $e) {
            throw $e;
        } finally {
            unset($conn);
        }
    }
    function pdo_query_value($sql)
    {
        $sql_args = array_slice(func_get_args(), 1);
        try {
            $conn = $this->pdo_get_connection();
            $stmt = $conn->prepare($sql);
            $stmt->execute($sql_args);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return array_values($row)[0];
        } catch (PDOException $e) {
            throw $e;
        } finally {
            unset($conn);
        }
    }
}

