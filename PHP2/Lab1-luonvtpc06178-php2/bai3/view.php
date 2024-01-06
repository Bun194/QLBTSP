<?php
    // Kiểm tra xem biến $khachhang có tồn tại và có chứa các phần tử cần thiết không
    if (isset($khachhang) && is_array($khachhang) && array_key_exists('email', $khachhang) && array_key_exists('matkhau', $khachhang)) {
        // Thực hiện hiển thị thông tin về người dùng
        echo "Email: ".$khachhang['email']." Mật khẩu:".$khachhang['matkhau'];
    } else {
        // Xử lý khi biến $khachhang không tồn tại hoặc không chứa các phần tử cần thiết
        echo "Không tìm thấy thông tin người dùng hoặc dữ liệu không đầy đủ.";
    }
?>

<form action="" method="post">
    <input type="email" name="email">
    <input type="submit">
</form>
