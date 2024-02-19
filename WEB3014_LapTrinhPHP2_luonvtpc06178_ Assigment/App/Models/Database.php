<?php

namespace App\Models;

use PDO;
use PDOException;
use mysqli;
use Dotenv\Dotenv;

class Database
{
    private static $dbHost;
    private static $dbName;
    private static $dbUser;
    private static $dbPassword;
    private static $dbPort;
    public function __construct()
    {
        // Load các biến môi trường từ file .env
        $dotenv = Dotenv::createImmutable(__DIR__); // Đường dẫn đến thư mục chứa file .env
        $dotenv->load();

        // Cài đặt các biến môi trường
        self::$dbHost = $_ENV["DB_HOST"];
        self::$dbName = $_ENV["DB_NAME"];
        self::$dbUser = $_ENV["DB_USER"];
        self::$dbPassword = $_ENV["DB_PASSWORD"];
        self::$dbPort = $_ENV["DB_PORT"];
    }
    public function PdO()
    {
        try {
            $conn = new PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName, self::$dbUser, self::$dbPassword);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    // function pdo_query_one($sql)
    // {
    //     $sql_args = array_slice(func_get_args(), 1);
    //     try {
    //         $conn = $this->PdO();
    //         $stmt = $conn->prepare($sql);
    //         $stmt->execute($sql_args);
    //         $row = $stmt->fetch(PDO::FETCH_ASSOC);
    //         return $row;
    //     } catch (PDOException $e) {
    //         throw $e;
    //     } finally {
    //         unset($conn);
    //     }
    // }
}
