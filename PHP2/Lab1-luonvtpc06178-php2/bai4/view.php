<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách Khách Hàng</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Danh sách Khách Hàng</h2>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên Khách Hàng</th>
                    <th>Email</th>
                    <th>Mật Khẩu</th>
                    <th>Số Điện Thoại</th>
                    <th>Địa Chỉ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($khachHangList as $khachHang): ?>
                    <tr>
                        <td><?= $khachHang['id'] ?></td>
                        <td><?= $khachHang['ten_khach_hang'] ?></td>
                        <td><?= $khachHang['email'] ?></td>
                        <td><?= $khachHang['mat_khau'] ?></td>
                        <td><?= $khachHang['so_dien_thoai'] ?></td>
                        <td><?= $khachHang['dia_chi'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
