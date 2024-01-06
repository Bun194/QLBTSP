<?php
    function get_user($email) {
        include 'config.php';

        $sql = "SELECT * FROM khachhang WHERE email = ?";
        $stmt = $connection->prepare($sql);

        // Sửa lỗi chính tả: bind_param thay vì blind_param
        $stmt->bind_param("s", $email);
        $stmt->execute(); // Sửa lỗi chính tả: execute thay vì excute

        /* Lấy kết quả */
        $result = $stmt->get_result(); // Sửa lỗi chính tả: result() thành get_result()

        // Sử dụng fetch_assoc thay vì fetch_array để lấy dữ liệu theo tên cột
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        }

        $stmt->close(); // Đóng statement
        $connection->close();
    }
?>
