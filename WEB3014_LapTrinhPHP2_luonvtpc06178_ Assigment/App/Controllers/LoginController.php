<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Core\BaseRender;
use App\Models\Database;
use App\Models\User;
use App\Models\QueryBuilder;
use App\Models\BaseModel;

class LoginController extends BaseController
{
    private $_renderBase;
    public $selectField = '*';
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
    function LoginController()
    {
        $this->loginPage();
    }
    function loginPage()
    {
        $this->_renderBase->renderAdminHeader();
        $this->load->render('login');
    }
    public function handleLogin()
    {

        // Tiếp tục xác thực thông tin đăng nhập
        if (empty($_POST["Email"]) || empty($_POST["Password"])) {
            $_SESSION['login_error'] = "Email và Password không được để trống!";
            header('Location: ?url=LoginController/loginPage');
            exit;
        }

        $userModel = new User();

        $user = $userModel->checkUserExist($_POST["Email"]);
        if (!$user || !password_verify($_POST['Password'], $user['Password'])) {
            $_SESSION['login_error'] = "Email và Password không khả dụng!";
            header('Location: ?url=LoginController/loginPage');
            exit;
        }

        // Đăng nhập thành công, lưu thông tin người dùng vào phiên
        $_SESSION['user'] = $user;

        // Chuyển hướng đến trang chính sau khi đăng nhập
        header("refresh:1; url=?url=HomeController");
        exit;
    }

    public function logout()
    {
        unset($_SESSION['user']);
        $this->redirect('?url=LoginController/loginPage');
    }
}
