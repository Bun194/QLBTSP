<?php
// Thông tin kết nối đến cơ sở dữ liệu
$databaseHost = "localhost"; // Địa chỉ máy chủ MySQL
$databaseUser = "root"; // Tên người dùng MySQL
$databasePassword = "123"; // Mật khẩu MySQL
$databaseName = "baotri"; // Tên cơ sở dữ liệu

// Tạo kết nối
$connection = new mysqli($databaseHost, $databaseUser, $databasePassword, $databaseName);

// Kiểm tra kết nối
if ($connection->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $connection->connect_error);
}
?>
