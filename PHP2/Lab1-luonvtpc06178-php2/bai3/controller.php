<?php
    include 'model.php';

    // Kiểm tra xem 'email' có tồn tại trong $_POST hay không
    $email = isset($_POST['email']) ? $_POST['email'] : null;

    // Tiếp tục chỉ khi 'email' tồn tại
    if ($email !== null) {
        $khachhang = get_user($email);
        include 'view.php';
    } else {
        // Xử lý khi 'email' không tồn tại
        echo "Không tìm thấy dữ liệu email trong biểu mẫu.";
    }
?>
