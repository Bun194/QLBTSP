<?php
// Hàm để lấy tất cả các khách hàng từ bảng 'khach_hang'
function getAllKhachHang($connection) {
    // Bước 1: Truy vấn SQL
    $sql = "SELECT * FROM khach_hang";

    // Bước 2: Thực hiện truy vấn
    $result = $connection->query($sql);

    // Bước 3: Khởi tạo một mảng rỗng để lưu trữ các bản ghi được truy vấn
    $khachHangList = [];

    // Bước 4: Kiểm tra xem có hàng nào trong kết quả trả về không
    if ($result->num_rows > 0) {
        // Bước 5: Lặp qua từng hàng trong kết quả trả về
        while ($row = $result->fetch_assoc()) {
            // Bước 6: Thêm từng hàng (dưới dạng mảng kết hợp) vào mảng $khachHangList
            $khachHangList[] = $row;
        }
    }

    // Bước 7: Trả về mảng chứa tất cả các bản ghi từ bảng 'khach_hang'
    return $khachHangList;
}
?>
