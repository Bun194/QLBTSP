<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Core\BaseRender;
use App\Models\User;

class ResetPasswordController extends BaseController
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
        $this->ResetPasswordController();
    }
    function ResetPasswordController()
    {
        $this->resetpasswordPage();
    }
    function resetpasswordPage()
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
        $this->load->render('resetpassword');
        // $this->_renderBase->renderAdminFooter();
    }
    public function handleResetPassword()
{
    $errors = [];

    if (empty($_POST["Email"])) {
        $errors['Email'] = "Email không được bỏ trống!";
    }

    if (empty($_POST["NewPassword"])) {
        $errors['NewPassword'] = "Mật khẩu mới không được bỏ trống!";
    } elseif (strlen($_POST["NewPassword"]) < 8) {
        $errors['NewPassword'] = "Mật khẩu mới phải chứa ít nhất 8 ký tự!";
    }

    if (!empty($errors)) {
        $_SESSION['validation_errors'] = $errors;
        header('Location: ?url=ResetPasswordController/handleResetPassword');
        exit;
    }

    $userModel = new User();
    $user = $userModel->checkUserExist($_POST["Email"]);

    if (!$user) {
        $_SESSION['user_error'] = "Tài khoản không tồn tại!";
        header('Location: ?url=ResetPasswordController/handleResetPassword');
        exit;
    }

    // Mã hóa mật khẩu mới trước khi cập nhật vào cơ sở dữ liệu
    $hashedPassword = password_hash($_POST['NewPassword'], PASSWORD_DEFAULT);
    // Xác định điều kiện để xác định người dùng cần được cập nhật
    $condition = "Email = '" . $_POST['Email'] . "'";

    // Tạo một mảng chứa cặp khóa-giá trị để cập nhật
    $data = array(
        'Password' => $hashedPassword // Mật khẩu mới đã được mã hóa
    );

    // Cập nhật dữ liệu trong cơ sở dữ liệu
    $userModel->updateData('employees', $data, $condition);

    $_SESSION['reset_password_success_message'] = "Reset password successful!";
    header('location: ?url=LoginController/loginPage');
    exit;
}

}
