<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Core\BaseRender;
use App\Models\User;
use App\Models\Product;
use App\Models\Staff;
use App\Models\Maintenance;

class HomeController extends BaseController
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
        $this->HomeController();
    }
    function HomeController()
    {
        $this->homePage();
    }
    function homePage()
{
    // Lấy số lượng sản phẩm từ CSDL
    $product = new Product();
    $staff = new Staff();
    $maintenance = new Maintenance();

    $productCount = $product->countAllProducts();
    $staffCount = $staff->countAllStaff();
    $maintenanceCount = $maintenance->countAllMaintenance();
    $maintenanceData = $maintenance->totalCostAll(); // Giả sử đây là hàm lấy dữ liệu bảo trì từ CSDL
    // Tạo dữ liệu cho biểu đồ đường từ dữ liệu bảo trì
    $labels = array_keys($maintenanceData); // Sử dụng các ngày trong tuần làm nhãn
    $datas = array_values($maintenanceData); // Sử dụng tổng chi phí làm dữ liệu
    // Tạo một mảng dữ liệu mới cho biểu đồ đường
    $lineChart = array(
        'labels' => $labels,
        'data' => $datas
    );
    // Chuyển đổi dữ liệu thành chuỗi JSON
    $lineChartData = json_encode($lineChart);

    // Tạo một mảng chứa số lượng sản phẩm
    $data = array(
        'productCount' => $productCount,
        'staffCount' => $staffCount,
        'maintenanceCount' => $maintenanceCount,
    );

    // Chuyển đổi mảng PHP thành chuỗi JSON
    $doughnutData = json_encode(array_values($data));
    // Tiếp tục với code HTML
    $this->_renderBase->renderAdminHeader();
    $this->_renderBase->renderAdminNav();
    $this->load->render('home', ['data' => $data, 'doughnutData' => $doughnutData, 'lineChartData' => $lineChartData]);
    $this->_renderBase->renderAdminFooter();
}
    function profile($EmployeeID){
        $userModels = new User();
        $profile = $userModels->getOne($EmployeeID);
        $data = $profile;
        $this->load->render('profile');
    }
}
