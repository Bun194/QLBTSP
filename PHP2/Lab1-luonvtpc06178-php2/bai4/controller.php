<?php
include 'model.php';
include 'config.php';

// Lấy tất cả khách hàng từ cơ sở dữ liệu
$khachHangList = getAllKhachHang($connection);

// Include view để hiển thị dữ liệu
include 'view.php';
?>


