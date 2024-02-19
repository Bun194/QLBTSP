<?php

namespace App\Models;

use App\Interfaces\CrudInterface;
use App\Models\Database;
use PDO;
use Exception;
use App\Models\QueryBuilder;

abstract class BaseModel implements CrudInterface
{
    use QueryBuilder;

    protected $table;
    private $_connection;
    protected $name = "BaseModel";
    private $_query;

    public function __construct()
    {
        $this->_connection = new Database();
    }
    public function search($table, $keyword)
    {
        // Sử dụng LIKE để tìm kiếm các từ khóa gần giống trong trường Description
        $sql = "SELECT * FROM $table WHERE Description LIKE :keyword";
        // Chuẩn bị câu truy vấn SQL
        $stmt = $this->_connection->PDO()->prepare($sql);
        // Gán giá trị cho tham số và thiết lập kiểu dữ liệu của nó
        $keyword = '%' . $keyword . '%'; // Sử dụng ký tự đại diện % để tìm kiếm từ khóa gần giống
        $stmt->bindParam(':keyword', $keyword, PDO::PARAM_STR);
        // Thực thi câu truy vấn
        $stmt->execute();
        // Trả về kết quả dưới dạng mảng kết hợp
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // abstract public function getAllWithPaginate(int $limit, int $offset);
    public function getAllWithPaginate(int $limit, int $page)
    {
        // Tính toán offset dựa trên limit và page
        $offset = max(0, ($page - 1) * $limit);

        // Tạo câu truy vấn SQL với LIMIT và OFFSET
        $sql = "SELECT * FROM $this->table LIMIT :limit OFFSET :offset";

        // Chuẩn bị câu truy vấn
        $stmt = $this->_connection->PDO()->prepare($sql);

        // Bind giá trị cho tham số
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        // Thực thi câu truy vấn
        $stmt->execute();

        // Trả về kết quả dưới dạng mảng kết hợp
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAll()
    {
        $this->_query = "SELECT * FROM $this->tableName";

        // return $this;

        $stmt   = $this->_connection->PdO()->prepare($this->_query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function orderBy(string $order = 'ASC')
    {
        $this->_query = $this->_query . "order by " . $order;

        return $this;
    }
    public function get()
    {
        $stmt = $this->_connection->PDO()->prepare($this->_query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getOne(int $id)
    {
        $this->_query = "SELECT * FROM $this->table WHERE id=$id";

        $stmt   = $this->_connection->PdO()->prepare($this->_query);


        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function limit(int $limit = 10)
    {
        $stmt   = $this->_connection->PDO()->prepare($this->_query);
        $result = $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function remove(int $id): bool
    {
        return true;
    }
    public function insertData($table, $data)
    {
        if (!empty($data)) {
            $fielStr  = '';
            $valueStr = '';
            foreach ($data as $key => $value) {
                $fielStr .= $key . ',';
                $valueStr .= "'" . $value . "',";
            }

            $fielStr  = rtrim($fielStr, ',');
            $valueStr = rtrim($valueStr, ',');
            $sql      = "INSERT INTO  $table($fielStr) VALUES ($valueStr)";

            $status = $this->query($sql);
            if (!$status)
                return false;
        }
        return true;
    }
    public function updateData($table, $data, $condition = '')
    {
        if (!empty($data)) {
            $updateStr = '';
            foreach ($data as $key => $value) {
                if ($value === '' || $value === null) {
                    $updateStr .= "$key=NULL,";
                } else {
                    $updateStr .= "$key='$value',";
                }
            }
            $updateStr = rtrim($updateStr, ',');
            $sql       = "UPDATE $table SET $updateStr";
            if (!empty($condition)) {
                $sql = "UPDATE $table SET $updateStr WHERE $condition";
            }
            $status = $this->query($sql);
            if (!$status)
                return false;
        }
        return true;
    }
    public function update(int $id, array $data)
    {
        // $data=[
        //     'name'=> $name,
        //     'status'=> $status,
        //     'description'=> $description
        // ];
        // $this->_query = "UPDATE $this->table SET name='$name',status='$status' WHERE id=$id";
        // tạo câu truy vấn
        $this->_query = "UPDATE $this->table SET ";
        foreach ($data as $key => $value) {
            $this->_query .= "$key = '$value', ";
        }
        $this->_query = rtrim($this->_query, ", ");

        $this->_query .= " WHERE id=$id";
        //    $sql .= " WHERE ";
        //    foreach ($conditions as $key => $value) {
        //        $sql .= "$key = :$key AND ";
        //    }
        //    $sql = rtrim($sql, "AND ");
        // chuẩn bị câu truy vấn
        $stmt = $this->_connection->PdO()->prepare($this->_query);

        // bind các giá trị
        // foreach ($data as $key => $value) {
        //     $stmt->bindValue(":$key", $value);
        // }
        //    foreach ($conditions as $key => $value) {
        //        $stmt->bindValue(":$key", $value);
        //    }

        // return $stmt;
        // thực hiện câu truy vấn
        return $stmt->execute();
        // return $this->_query;
    }
    public function deleteData($table, $condition = ''): bool
    {
        $sql = 'DELETE FROM ' . $table;
        if (!empty($condition)) {
            $sql = 'DELETE FROM ' . $table . ' WHERE ' . $condition;
        }
        $status = $this->query($sql);
        if (!$status)
            return false;
        return true;
    }
    public function delete(int $id): bool
    {
        $this->_query = "DELETE FROM $this->table WHERE id=$id";

        $stmt   = $this->_connection->PdO()->prepare($this->_query);
        $stmt->execute();
        $affected_rows = $stmt->rowCount();
        return $affected_rows;
    }
    public function query($sql)
    {
        try {
            $statement = $this->_connection->PDO()->prepare($sql);
            $statement->execute();
            return $statement;
        } catch (Exception $ex) {
            $mess = $ex->getMessage();
            echo $mess;
            die();
        }
    }
    public function countAll()
    {
        try {
            // Tạo câu truy vấn SQL để đếm số lượng sản phẩm
            $sql = "SELECT COUNT(*) AS total FROM $this->table";

            // Chuẩn bị câu truy vấn
            $stmt = $this->_connection->PDO()->prepare($sql);

            // Thực thi câu truy vấn
            $stmt->execute();

            // Lấy kết quả từ câu truy vấn
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // Trả về số lượng sản phẩm
            return $result['total'];
        } catch (Exception $ex) {
            // Xử lý ngoại lệ nếu có
            $mess = $ex->getMessage();
            echo $mess;
            die(); // Có thể xử lý theo cách phù hợp với ứng dụng của bạn
        }
    }
    public function totalCost()
    {
        $totalCostByDay = array();
        $labels = array(); // Mảng chứa nhãn cho trục x
        $data = array(); // Mảng chứa giá trị cho trục y

        // Lặp qua mỗi ngày trong tuần
        for ($day = 0; $day < 7; $day++) {
            // Lấy ngày trong tuần (từ 0 đến 6, 0 là Chủ Nhật)
            $currentDay = date('N', strtotime("Sunday +$day days"));

            // Thêm nhãn cho trục x (ngày trong tuần)
            $labels[] = "Ngày $currentDay"; // Bạn có thể đổi cách hiển thị nhãn tùy ý

            // Tính tổng tiền cho ngày trong tuần
            $sql = "SELECT DAYOFWEEK(MaintenanceDate) AS dayOfWeek, SUM(MaintenanceCost) AS totalCost FROM $this->table GROUP BY DAYOFWEEK(MaintenanceDate)";

            $stmt = $this->_connection->PDO()->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // Thêm giá trị cho trục y
            $data[] = $result['totalCost'] ?? 0; // Nếu không có dữ liệu, gán giá trị mặc định là 0

            // Lưu tổng tiền vào mảng với key là ngày trong tuần
            $totalCostByDay[$currentDay] = $result['totalCost'];
        }

        // Trả về một mảng chứa cả dữ liệu cho trục x và trục y
        return array(
            'labels' => $labels,
            'data' => $data
        );
    }
}
