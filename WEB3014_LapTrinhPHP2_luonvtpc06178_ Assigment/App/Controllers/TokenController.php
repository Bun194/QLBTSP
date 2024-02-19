<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Core\BaseRender;
use App\Models\User;

class TokenController extends BaseController
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
        $this->TokenController();
    }
    function TokenController()
    {
        $this->tokenPage();
    }
    function tokenPage()
    {
        // dữ liệu ở đây lấy từ repositories hoặc model
        // $data = [
        //     "products" => [
        //         [
        //             "id" => 1,
        //             "name" => "Sản phẩm"
        //         ]
        //     ]
        // ];

        $this->_renderBase->renderAdminHeader();
        $this->load->render('token');
        // $this->_renderBase->renderAdminFooter();
    }
    public function tokenComfirm()
{
    // Kiểm tra xem người dùng đã nhập token chưa
    if (isset($_POST['token']) && !empty($_POST['token'])) {
        // Lấy token từ form
        $token = $_POST['token'];

        // Kiểm tra xem token có đúng không
        if ($token == $_SESSION['reset_token']) {
            // Redirect người dùng đến trang reset mật khẩu nếu token đúng
            header('Location: ?url=ResetPasswordController');
            exit();
        } else {
            // Thông báo cho người dùng biết token không đúng
            $_SESSION['reset_error'] = "Mã xác nhận không đúng. Vui lòng thử lại!";
            header('Location: ?url=TokenController');
            exit();
        }
    } else {
        // Nếu người dùng không nhập token, chuyển hướng lại trang xác nhận token với thông báo lỗi
        $_SESSION['reset_error'] = "Vui lòng nhập mã xác nhận!";
        header('Location: ?url=TokenController');
        exit();
    }
}

}
?>