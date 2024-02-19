<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Core\BaseRender;
use App\Models\Staff;

class StaffController extends BaseController
{

    private $_renderBase;

    /**
     * Thuốc trị đau lưng
     * Copy lại là hết đau lưng
     * 
     */
    function __construct()
    {
        parent::__construct();
        $this->_renderBase = new BaseRender();
    }
    function StaffPage()
    {
        $staff = new Staff();

        // Số bản ghi trên mỗi trang
        $limit = 5;

        // Số trang hiện tại, mặc định là 1
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

        // Lấy tổng số lượng nhân viên
        $totalStaff = count($staff->getAllStaff());

        // Tính toán số trang
        $totalPages = ceil($totalStaff / $limit);


        // Lấy dữ liệu cho trang hiện tại
        $data = $staff->getAllWithPaginateDemo($limit, $currentPage);

        if (!is_array($data)) {
            $data = [];
        }

        // Truyền dữ liệu phân trang vào view
        $paginationData = [
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'baseUrl' => ROOT_URL . '?url=StaffController/StaffPage',
        ];

        // Render view và truyền dữ liệu phân trang
        $this->_renderBase->renderAdminHeader();
        $this->_renderBase->renderAdminNav();
        $this->load->render('admin/staff/staff', ['data' => $data, 'paginationData' => $paginationData]);
        $this->_renderBase->renderAdminFooter();
        var_dump($totalPages);
    }
    function createStaff()
    {
        $this->_renderBase->renderAdminHeader();
        $this->_renderBase->renderAdminNav();
        $this->load->render('admin/staff/add-staff');
        $this->_renderBase->renderAdminFooter();
    }
    function store()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Xử lý dữ liệu form
            $EmployeeName = isset($_POST['EmployeeName']) ? $_POST['EmployeeName'] : '';
            $Address = isset($_POST['Address']) ? $_POST['Address'] : '';
            $PhoneNumber = isset($_POST['PhoneNumber']) ? $_POST['PhoneNumber'] : '';
            $Email = isset($_POST['Email']) ? $_POST['Email'] : '';
            $Password = isset($_POST['Password']) ? $_POST['Password'] : '';

            // Mã hóa mật khẩu
            $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);

            // Kết nối CSDL và thực hiện truy vấn để lưu dữ liệu
            $createProduct = new Staff();
            $table = 'employees';
            $data = [
                'EmployeeName' => $EmployeeName,
                'Address' => $Address,
                'PhoneNumber' => $PhoneNumber,
                'Email' => $Email,
                'Password' => $hashedPassword, // Sử dụng mật khẩu đã được mã hóa
            ];

            $result = $createProduct->insertDataStaff($table, $data);

            if ($result) {
                header('location: ' . ROOT_URL . '?url=StaffController/StaffPage');
                exit; // Đảm bảo không có mã HTML hoặc mã PHP nào được gửi sau khi chuyển hướng
            } else {
                echo 'Thêm lỗi';
            }
        } else {
            echo 'Không có dữ liệu được gửi từ form.';
        }
    }
    function deleteStaff($id)
    {
        // Lấy ID của người dùng đang đăng nhập
        $loggedInUserID = $_SESSION['user']; // Đây là ví dụ, hãy thay thế bằng cách lấy ID của người dùng từ phiên hoặc cookie

        // Kiểm tra xem người dùng đang cố gắng xóa chính mình hay không
        if ($id == $loggedInUserID) {
            echo '0'; // Trả về giá trị 0 để hiển thị thông báo trong JavaScript
            return;
        }

        // Nếu không phải là xóa chính mình, tiếp tục xóa
        $staff = new Staff();
        $data = $staff->deleteStaff($id);

        if ($data) {
            header('location: ' . ROOT_URL . '?url=StaffController/StaffPage');
        } else {
            echo 'Xóa lỗi!';
        }
    }

    function detailUpdate($id)
    {
        // dữ liệu ở đây lấy từ repositories hoặc model
        $product = new Staff();
        $data = $product->getOneStaff($id);
        $this->_renderBase->renderAdminHeader();
        $this->_renderBase->renderAdminNav();
        // $this->load->render('layouts/client/slider');
        $this->load->render('admin/staff/update-staff', $data);
        $this->_renderBase->renderAdminFooter();
    }
    function updateStaff($id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Xử lý dữ liệu form
            $EmployeeName = isset($_POST['EmployeeName']) ? $_POST['EmployeeName'] : '';
            $Address = isset($_POST['Address']) ? $_POST['Address'] : '';
            $PhoneNumber = isset($_POST['PhoneNumber']) ? $_POST['PhoneNumber'] : '';
            $Email = isset($_POST['Email']) ? $_POST['Email'] : '';
            $Password = isset($_POST['Password']) ? $_POST['Password'] : '';
            // Mã hóa mật khẩu
            $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);
            // Kết nối CSDL và thực hiện truy vấn để cập nhật dữ liệu
            $updateStaff = new Staff();
            $data = [
                'EmployeeName' => $EmployeeName,
                'Address' => $Address,
                'PhoneNumber' => $PhoneNumber,
                'Email' => $Email,
                'Password' => $hashedPassword, // Sử dụng mật khẩu đã được mã hóa
            ];
            $result = $updateStaff->updateDataStaff($id, $data);
            if ($result) {
                header('location: ' . ROOT_URL . '?url=StaffController/StaffPage');
                exit; // Đảm bảo không có mã HTML hoặc mã PHP nào được gửi sau khi chuyển hướng
            } else {
                echo 'Cập nhật lỗi';
            }
        } else {
            echo 'Không có dữ liệu được gửi từ form.';
        }
    }
}
