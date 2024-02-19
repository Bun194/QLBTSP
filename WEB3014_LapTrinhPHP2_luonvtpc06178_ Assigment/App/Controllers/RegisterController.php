<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Core\BaseRender;
use App\Models\User;

class RegisterController extends BaseController
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
        $this->RegisterController();
    }
    function RegisterController()
    {
        $this->registerPage();
    }
    function registerPage()
    {
        $this->_renderBase->renderAdminHeader();
        $this->load->render('register');
        // $this->_renderBase->renderAdminFooter();
    }
    public function handleRegister()
{
    $errors = [];

    // Kiểm tra tên không được bỏ trống
    if (empty($_POST["EmployeeName"])) {
        $errors['EmployeeName'] = "Tên không được bỏ trống!";
    }
    // Kiểm tra email không được bỏ trống và đúng định dạng
    if (empty($_POST["Email"]) || !filter_var($_POST["Email"], FILTER_VALIDATE_EMAIL)) {
        $errors['Email'] = "Email không hợp lệ!";
    }
    // Kiểm tra mật khẩu không được bỏ trống và ít nhất 8 ký tự
    if (empty($_POST["Password"]) || strlen($_POST["Password"]) < 8) {
        $errors['Password'] = "Mật khẩu phải chứa ít nhất 8 ký tự!";
    }

    if (!empty($errors)) {
        $_SESSION['validation_errors'] = $errors;
        header('Location: ?url=RegisterController');
        exit;
    }

    $userModel = new User();
    $user = $userModel->checkUserExist($_POST["Email"]);

    if ($user) {
        $_SESSION['user_error'] = "Tài khoản đã tồn tại!";
        header('Location: ?url=RegisterController');
        exit;
    }

    // Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu
    $hashedPassword = password_hash($_POST['Password'], PASSWORD_DEFAULT);

    // Thêm mật khẩu đã mã hóa vào dữ liệu người dùng
    $_POST['Password'] = $hashedPassword;

    // Gọi phương thức đăng ký người dùng
    $userModel->registerUser($_POST);

    $_SESSION['registration_success_message'] = "Registration successful!";
    header('location: ?url=LoginController/loginPage');
    exit;
}

}
