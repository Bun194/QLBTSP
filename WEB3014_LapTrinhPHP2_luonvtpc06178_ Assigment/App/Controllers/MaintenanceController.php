<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Core\BaseRender;
use App\Models\Maintenance;

class MaintenanceController extends BaseController
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
        // $this->MaintenanceController();
    }
    // function MaintenanceController()
    // {
    //     $this->MaintenancePage();
    // }
    // function MaintenancePage()
    // {
    //     $maintenance = new Maintenance();
    //     $data = $maintenance->getAllMaintenance();
    //     if (!is_array($data)) {
    //         $data = [];
    //     }
    //     $this->_renderBase->renderAdminHeader();
    //     $this->_renderBase->renderAdminNav();
    //     $this->load->render('admin/maintenance/maintenance', $data);
    //     $this->_renderBase->renderAdminFooter();
    // }
    function MaintenancePage()
    {
        $staff = new Maintenance();

        // Số bản ghi trên mỗi trang
        $limit = 2;

        // Số trang hiện tại, mặc định là 1
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

        // Lấy tổng số lượng nhân viên
        $totalStaff = count($staff->getAllMaintenance());

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
            'baseUrl' => ROOT_URL . '?url=MaintenanceController/MaintenancePage',
        ];

        // Render view và truyền dữ liệu phân trang
        $this->_renderBase->renderAdminHeader();
        $this->_renderBase->renderAdminNav();
        $this->load->render('admin/maintenance/maintenance', ['data' => $data, 'paginationData' => $paginationData]);
        $this->_renderBase->renderAdminFooter();
    }
    function createMaintenance()
    {
        $this->_renderBase->renderAdminHeader();
        $this->_renderBase->renderAdminNav();
        $this->load->render('admin/maintenance/add-maintenance');
        $this->_renderBase->renderAdminFooter();
    }
    function store()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Xử lý dữ liệu form
            $ProductsID = isset($_POST['ProductsID']) ? $_POST['ProductsID'] : '';
            $EmployeeID = isset($_POST['EmployeeID']) ? $_POST['EmployeeID'] : '';
            $MaintenanceDate = isset($_POST['MaintenanceDate']) ? $_POST['MaintenanceDate'] : '';
            $Description = isset($_POST['Description']) ? $_POST['Description'] : '';
            $MaintenanceCost = isset($_POST['MaintenanceCost']) ? $_POST['MaintenanceCost'] : '';
            $Status = isset($_POST['Status']) ? $_POST['Status'] : '';

            // Kết nối CSDL và thực hiện truy vấn để lưu dữ liệu
            $createMaintenance = new Maintenance();
            $table = 'maintenance';
            $data = [
                'ProductsID' => $ProductsID,
                'EmployeeID' => $EmployeeID,
                'MaintenanceDate' => $MaintenanceDate,
                'Description' => $Description,
                'MaintenanceCost' => $MaintenanceCost,
                'Status' => $Status
            ];

            $result = $createMaintenance->insertDataMaintenance($table, $data);

            if ($result) {
                header('location: ' . ROOT_URL . '?url=MaintenanceController/MaintenancePage');
                exit; // Đảm bảo không có mã HTML hoặc mã PHP nào được gửi sau khi chuyển hướng
            } else {
                echo 'Thêm lỗi';
            }
        } else {
            echo 'Không có dữ liệu được gửi từ form.';
        }
    }
    function deleteMaintenance($id)
    {
        $maintenance = new Maintenance();
        $data = $maintenance->deleteMaintenance($id);

        if ($data) {
            header('location: ' . ROOT_URL . '?url=MaintenanceController/MaintenancePage');
        } else {
            echo 'Xóa lỗi!';
        }
    }
    function detailUpdate($id)
    {
        // dữ liệu ở đây lấy từ repositories hoặc model
        $maintenance = new Maintenance();
        $data = $maintenance->getOneMaintenance($id);
        $this->_renderBase->renderAdminHeader();
        $this->_renderBase->renderAdminNav();
        // $this->load->render('layouts/client/slider');
        $this->load->render('admin/maintenance/update-maintenance', $data);
        $this->_renderBase->renderAdminFooter();
    }
    function updateMaintenance($id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Xử lý dữ liệu form
            $ProductsID = isset($_POST['ProductsID']) ? $_POST['ProductsID'] : '';
            $EmployeeID = isset($_POST['EmployeeID']) ? $_POST['EmployeeID'] : '';
            $MaintenanceDate = isset($_POST['MaintenanceDate']) ? $_POST['MaintenanceDate'] : '';
            $Description = isset($_POST['Description']) ? $_POST['Description'] : '';
            $MaintenanceCost = isset($_POST['MaintenanceCost']) ? $_POST['MaintenanceCost'] : '';
            $Status = isset($_POST['Status']) ? $_POST['Status'] : '';

            // Kết nối CSDL và thực hiện truy vấn để cập nhật dữ liệu
            $updateMaintenance = new Maintenance();
            $data = [
                'ProductsID' => $ProductsID,
                'EmployeeID' => $EmployeeID,
                'MaintenanceDate' => $MaintenanceDate,
                'Description' => $Description,
                'MaintenanceCost' => $MaintenanceCost,
                'Status' => $Status
            ];

            $result = $updateMaintenance->updateDataMaintenance($id, $data);

            if ($result) {
                header('location: ' . ROOT_URL . '?url=MaintenanceController/MaintenancePage');
                exit; // Đảm bảo không có mã HTML hoặc mã PHP nào được gửi sau khi chuyển hướng
            } else {
                echo 'Cập nhật lỗi';
            }
        } else {
            echo 'Không có dữ liệu được gửi từ form.';
        }
    }
    
    function Search()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Lấy từ khóa tìm kiếm từ form
            $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';

            // Kiểm tra xem từ khóa có rỗng không
            if (!empty($keyword)) {
                $staff = new Maintenance();

                // Gọi phương thức search từ model
                $searchResult = $staff->SearchHome('maintenance', $keyword);

                // Hiển thị kết quả tìm kiếm
                $this->_renderBase->renderAdminHeader();
                $this->_renderBase->renderAdminNav();
                $this->load->render('search', ['searchResult' => $searchResult]);
                $this->_renderBase->renderAdminFooter();
            } else {
                // Nếu từ khóa tìm kiếm rỗng, chuyển hướng trở lại trang StaffPage
                header('location: ' . ROOT_URL . '?url=StaffController/StaffPage');
                exit;
            }
        } else {
            // Nếu không phải là phương thức POST, chuyển hướng về trang StaffPage
            header('location: ' . ROOT_URL . '?url=StaffController/StaffPage');
            exit;
        }
    }
}
